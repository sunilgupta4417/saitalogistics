<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Common;
use App\Models\{
    User,
    Shipment
    };
use FedEx\AddressValidationService\ComplexType;
use FedEx\AddressValidationService\Request;
use FedEx\AddressValidationService\SimpleType;
// use FedEx\RateService\ComplexType;
// use FedEx\RateService\Request;
// use FedEx\RateService\SimpleType;
use FedEx\ShipService;
// use FedEx\ShipService\ComplexType;
// use FedEx\ShipService\SimpleType;
// use FedEx\TrackService\ComplexType;
// use FedEx\TrackService\Request;
// use FedEx\TrackService\SimpleType;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Artisan,
    Validator,
    Session,
    Hash,
    Auth,
    DB
};

class FedexController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper       = new Common();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_rate()
    {
        $rateRequest = new ComplexType\RateRequest();

        //authentication & client details
        $rateRequest->WebAuthenticationDetail->UserCredential->Key = FEDEX_KEY;
        $rateRequest->WebAuthenticationDetail->UserCredential->Password = FEDEX_PASSWORD;
        $rateRequest->ClientDetail->AccountNumber = FEDEX_ACCOUNT_NUMBER;
        $rateRequest->ClientDetail->MeterNumber = FEDEX_METER_NUMBER;

        $rateRequest->TransactionDetail->CustomerTransactionId = 'testing rate service request';

        //version
        $rateRequest->Version->ServiceId = 'crs';
        $rateRequest->Version->Major = 31;
        $rateRequest->Version->Minor = 0;
        $rateRequest->Version->Intermediate = 0;

        $rateRequest->ReturnTransitAndCommit = true;

        //shipper
        $rateRequest->RequestedShipment->PreferredCurrency = 'USD';
        $rateRequest->RequestedShipment->Shipper->Address->StreetLines = ['10 Fed Ex Pkwy'];
        $rateRequest->RequestedShipment->Shipper->Address->City = 'Memphis';
        $rateRequest->RequestedShipment->Shipper->Address->StateOrProvinceCode = 'TN';
        $rateRequest->RequestedShipment->Shipper->Address->PostalCode = 38115;
        $rateRequest->RequestedShipment->Shipper->Address->CountryCode = 'US';

        //recipient
        $rateRequest->RequestedShipment->Recipient->Address->StreetLines = ['13450 Farmcrest Ct'];
        $rateRequest->RequestedShipment->Recipient->Address->City = 'Herndon';
        $rateRequest->RequestedShipment->Recipient->Address->StateOrProvinceCode = 'VA';
        $rateRequest->RequestedShipment->Recipient->Address->PostalCode = 20171;
        $rateRequest->RequestedShipment->Recipient->Address->CountryCode = 'US';

        //shipping charges payment
        $rateRequest->RequestedShipment->ShippingChargesPayment->PaymentType = SimpleType\PaymentType::_SENDER;

        //rate request types
        $rateRequest->RequestedShipment->RateRequestTypes = [SimpleType\RateRequestType::_PREFERRED, SimpleType\RateRequestType::_LIST];

        $rateRequest->RequestedShipment->PackageCount = 2;

        //create package line items
        $rateRequest->RequestedShipment->RequestedPackageLineItems = [new ComplexType\RequestedPackageLineItem(), new ComplexType\RequestedPackageLineItem()];

        //package 1
        $rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Weight->Value = 2;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Weight->Units = SimpleType\WeightUnits::_LB;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Dimensions->Length = 10;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Dimensions->Width = 10;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Dimensions->Height = 3;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Dimensions->Units = SimpleType\LinearUnits::_IN;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[0]->GroupPackageCount = 1;

        //package 2
        $rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Weight->Value = 5;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Weight->Units = SimpleType\WeightUnits::_LB;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Dimensions->Length = 20;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Dimensions->Width = 20;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Dimensions->Height = 10;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Dimensions->Units = SimpleType\LinearUnits::_IN;
        $rateRequest->RequestedShipment->RequestedPackageLineItems[1]->GroupPackageCount = 1;

        $rateServiceRequest = new Request();
        //$rateServiceRequest->getSoapClient()->__setLocation(Request::PRODUCTION_URL); //use production URL

        $rateReply = $rateServiceRequest->getGetRatesReply($rateRequest); // send true as the 2nd argument to return the SoapClient's stdClass response.


        if (!empty($rateReply->RateReplyDetails)) {
            foreach ($rateReply->RateReplyDetails as $rateReplyDetail) {
                var_dump($rateReplyDetail->ServiceType);
                if (!empty($rateReplyDetail->RatedShipmentDetails)) {
                    foreach ($rateReplyDetail->RatedShipmentDetails as $ratedShipmentDetail) {
                        var_dump($ratedShipmentDetail->ShipmentRateDetail->RateType . ": " . $ratedShipmentDetail->ShipmentRateDetail->TotalNetCharge->Amount);
                    }
                }
                echo "<hr />";
            }
        }

        var_dump($rateReply);
    }


    public function trackShipment($id)
    {
        $trackRequest = new ComplexType\TrackRequest();

// User Credential
        $trackRequest->WebAuthenticationDetail->UserCredential->Key = FEDEX_KEY;
        $trackRequest->WebAuthenticationDetail->UserCredential->Password = FEDEX_PASSWORD;

        // Client Detail
        $trackRequest->ClientDetail->AccountNumber = FEDEX_ACCOUNT_NUMBER;
        $trackRequest->ClientDetail->MeterNumber = FEDEX_METER_NUMBER;

        // Version
        $trackRequest->Version->ServiceId = 'trck';
        $trackRequest->Version->Major = 20;
        $trackRequest->Version->Intermediate = 0;
        $trackRequest->Version->Minor = 0;

        // Track 2 shipments
        $trackRequest->SelectionDetails = [new ComplexType\TrackSelectionDetail(), new ComplexType\TrackSelectionDetail()];

        // For get all events
        $trackRequest->ProcessingOptions = [SimpleType\TrackRequestProcessingOptionType::_INCLUDE_DETAILED_SCANS];

        // Track shipment 1
        $trackRequest->SelectionDetails[0]->PackageIdentifier->Value = $trackingId1;
        $trackRequest->SelectionDetails[0]->PackageIdentifier->Type = SimpleType\TrackIdentifierType::_TRACKING_NUMBER_OR_DOORTAG;

        // Track shipment 2
        $trackRequest->SelectionDetails[1]->PackageIdentifier->Value = $trackingId2;
        $trackRequest->SelectionDetails[1]->PackageIdentifier->Type = SimpleType\TrackIdentifierType::_TRACKING_NUMBER_OR_DOORTAG;

        $request = new Request();
        try {
            $trackReply = $request->getTrackReply($trackRequest);
            var_dump($trackReply);
        } catch (\Exception $e) {
            echo $e->getMessage();
            echo $request->getSoapClient()->__getLastResponse();
        }
    }


    public function createShipment($id)
    {
        $shipment = Shipment::where('id' , $id)->first();
        $userCredential = new ComplexType\WebAuthenticationCredential();
        $userCredential
            ->setKey(FEDEX_KEY)
            ->setPassword(FEDEX_PASSWORD);

        $webAuthenticationDetail = new ComplexType\WebAuthenticationDetail();
        $webAuthenticationDetail->setUserCredential($userCredential);

        $clientDetail = new ComplexType\ClientDetail();
        $clientDetail
            ->setAccountNumber(FEDEX_ACCOUNT_NUMBER)
            ->setMeterNumber(FEDEX_METER_NUMBER);

        $version = new ComplexType\VersionId();
        $version
            ->setMajor(28)
            ->setIntermediate(0)
            ->setMinor(0)
            ->setServiceId('ship');

        $shipperAddress = new ComplexType\Address();
        $shipperAddress
            ->setStreetLines(['Address Line 1'])
            ->setCity('Austin')
            ->setStateOrProvinceCode('TX')
            ->setPostalCode('73301')
            ->setCountryCode('US');

        $shipperContact = new ComplexType\Contact();
        $shipperContact
            ->setCompanyName('Company Name')
            ->setEMailAddress('test@example.com')
            ->setPersonName('Person Name')
            ->setPhoneNumber(('123-123-1234'));

        $shipper = new ComplexType\Party();
        $shipper
            ->setAccountNumber(FEDEX_ACCOUNT_NUMBER)
            ->setAddress($shipperAddress)
            ->setContact($shipperContact);

        $recipientAddress = new ComplexType\Address();
        $recipientAddress
            ->setStreetLines(['Address Line 1'])
            ->setCity('Herndon')
            ->setStateOrProvinceCode('VA')
            ->setPostalCode('20171')
            ->setCountryCode('US');

        $recipientContact = new ComplexType\Contact();
        $recipientContact
            ->setPersonName('Contact Name')
            ->setPhoneNumber('1234567890');

        $recipient = new ComplexType\Party();
        $recipient
            ->setAddress($recipientAddress)
            ->setContact($recipientContact);

        $labelSpecification = new ComplexType\LabelSpecification();
        $labelSpecification
            ->setLabelStockType(new SimpleType\LabelStockType(SimpleType\LabelStockType::_PAPER_7X4POINT75))
            ->setImageType(new SimpleType\ShippingDocumentImageType(SimpleType\ShippingDocumentImageType::_PDF))
            ->setLabelFormatType(new SimpleType\LabelFormatType(SimpleType\LabelFormatType::_COMMON2D));

        $packageLineItem1 = new ComplexType\RequestedPackageLineItem();
        $packageLineItem1
            ->setSequenceNumber(1)
            ->setItemDescription('Product description')
            ->setDimensions(new ComplexType\Dimensions(array(
                'Width' => 10,
                'Height' => 10,
                'Length' => 25,
                'Units' => SimpleType\LinearUnits::_IN
            )))
            ->setWeight(new ComplexType\Weight(array(
                'Value' => 2,
                'Units' => SimpleType\WeightUnits::_LB
            )));

        $shippingChargesPayor = new ComplexType\Payor();
        $shippingChargesPayor->setResponsibleParty($shipper);

        $shippingChargesPayment = new ComplexType\Payment();
        $shippingChargesPayment
            ->setPaymentType(SimpleType\PaymentType::_SENDER)
            ->setPayor($shippingChargesPayor);

        $requestedShipment = new ComplexType\RequestedShipment();
        $requestedShipment->setShipTimestamp(date('c'));
        $requestedShipment->setDropoffType(new SimpleType\DropoffType(SimpleType\DropoffType::_REGULAR_PICKUP));
        $requestedShipment->setServiceType(new SimpleType\ServiceType(SimpleType\ServiceType::_FEDEX_GROUND));
        $requestedShipment->setPackagingType(new SimpleType\PackagingType(SimpleType\PackagingType::_YOUR_PACKAGING));
        $requestedShipment->setShipper($shipper);
        $requestedShipment->setRecipient($recipient);
        $requestedShipment->setLabelSpecification($labelSpecification);
        $requestedShipment->setRateRequestTypes(array(new SimpleType\RateRequestType(SimpleType\RateRequestType::_PREFERRED)));
        $requestedShipment->setPackageCount(1);
        $requestedShipment->setRequestedPackageLineItems([
            $packageLineItem1
        ]);
        $requestedShipment->setShippingChargesPayment($shippingChargesPayment);

        $processShipmentRequest = new ComplexType\ProcessShipmentRequest();
        $processShipmentRequest->setWebAuthenticationDetail($webAuthenticationDetail);
        $processShipmentRequest->setClientDetail($clientDetail);
        $processShipmentRequest->setVersion($version);
        $processShipmentRequest->setRequestedShipment($requestedShipment);

        $shipService = new ShipService\Request();
        //$shipService->getSoapClient()->__setLocation('https://ws.fedex.com:443/web-services/ship');
        $result = $shipService->getProcessShipmentReply($processShipmentRequest);

        var_dump($result);
        // Save .pdf label
        // file_put_contents('/path/to/label.pdf', $result->CompletedShipmentDetail->CompletedPackageDetails[0]->Label->Parts[0]->Image);
        var_dump($result->CompletedShipmentDetail->CompletedPackageDetails[0]->Label->Parts[0]->Image);
    }


    public function verifyAddress(Request $request)
    {
        $addressValidationRequest = new ComplexType\AddressValidationRequest();

            // User Credentials
            $addressValidationRequest->WebAuthenticationDetail->UserCredential->Key = FEDEX_KEY;
            $addressValidationRequest->WebAuthenticationDetail->UserCredential->Password = FEDEX_PASSWORD;

            // Client Detail
            $addressValidationRequest->ClientDetail->AccountNumber = FEDEX_ACCOUNT_NUMBER;
            $addressValidationRequest->ClientDetail->MeterNumber = FEDEX_METER_NUMBER;

            // Version
            $addressValidationRequest->Version->ServiceId = 'aval';
            $addressValidationRequest->Version->Major = 8;
            $addressValidationRequest->Version->Intermediate = 0;
            $addressValidationRequest->Version->Minor = 0;

            // Address(es) to validate.
            $addressValidationRequest->AddressesToValidate = [new ComplexType\AddressToValidate()]; 
            $addressValidationRequest->AddressesToValidate[0]->Address->StreetLines = ['12345 Main Street'];
            $addressValidationRequest->AddressesToValidate[0]->Address->City = 'Anytown';
            $addressValidationRequest->AddressesToValidate[0]->Address->StateOrProvinceCode = 'NY';
            $addressValidationRequest->AddressesToValidate[0]->Address->PostalCode = 47711;
            $addressValidationRequest->AddressesToValidate[0]->Address->CountryCode = 'US';

            $request = new Request();
            try {
                $addressValidationReply = $request->getAddressValidationReply($addressValidationRequest);
                var_dump($addressValidationReply);
            } catch (\Exception $e) {
                echo $e->getMessage();
                echo $request->getSoapClient()->__getLastResponse();
            }
    }

    
}
