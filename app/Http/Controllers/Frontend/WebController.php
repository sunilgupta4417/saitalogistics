<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Country;
use App\Models\State;

class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['cms'] = CMS::where('page_name' , 'home-top')->first();
        $data['cms1'] = CMS::where('page_name' , 'home-work')->get();
        $data['cms2'] = CMS::where('page_name' , 'home-bottom')->first();
        $data['cms']->page_link = json_decode($data['cms']->page_link);
        $data['service'] = CMS::where('page_name' , 'world-class-service')->get();
        $data['about'] = CMS::where('page_name' , 'home-about')->get();
        return view('frontend.landing.index' , $data);
    }

    public function about()
    {
        $data['cms'] = CMS::where('page_name' , 'about')->get();
        return view('frontend.about.index', $data);
    }

    public function services()
    {
        $data['cms'] = CMS::where('page_name' , 'service')->get();
        $data['cms1'] = CMS::where('page_name' , 'home-work')->get();
        $data['cms2'] = CMS::where('page_name' , 'home-bottom')->first();
        return view('frontend.services.index', $data);
    }

    public function shipping()
    {
        $country = Country::select('*')->get();
        return view('frontend.shipping.index' , compact('country'));
    }

    public function shippingStateList($id){
        $stateList = State::select('*')->where('country_id',$id)->get();
        return $stateList;
    }

    public function tracking()
    {
        return view('frontend.tracking.index');
    }

    public function support()
    {
        $data['cms'] = CMS::where('page_name' , 'support')->first();
        return view('frontend.support.index', $data);
    }

    public function faq()
    {
        // $data['cms'] = CMS::where('page_name' , 'faq')->first();
        $data['cms'] = CMS::where('page_name' , 'faq')->first();
        return view('frontend.faq.index', $data);
    }

    public function terms_conditions()
    {
        $data['cms'] = CMS::where('page_name' , 'terms')->first();
        return view('frontend.terms.index', $data);
    }

    public function privacy_policy()
    {
        $data['cms'] = CMS::where('page_name' , 'privacy')->first();
        return view('frontend.privacy.index', $data);
    }

    public function shippingRates(Request $request){
        $key = 'Hom60U9PNrzwJFIV';
        $password = 'C3Y0uxHnOk0dCnd8y9ywn2V06';
        $account_number = '510087100';
        $meter_number = '256489637';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://fedex.com/ws/rate/v13"><SOAP-ENV:Body><ns1:RateRequest>
        <ns1:WebAuthenticationDetail>
        <ns1:UserCredential>
        <ns1:Key>'.$key.'</ns1:Key>
        <ns1:Password>'.$password.'</ns1:Password>
        </ns1:UserCredential></ns1:WebAuthenticationDetail> 
        <ns1:ClientDetail>
        <ns1:AccountNumber>'.$account_number.'</ns1:AccountNumber>
        <ns1:MeterNumber>'.$meter_number.'</ns1:MeterNumber>
        </ns1:ClientDetail>
        <ns1:TransactionDetail><ns1:CustomerTransactionId> *** Rate Request v13 using PHP ***</ns1:CustomerTransactionId></ns1:TransactionDetail><ns1:Version><ns1:ServiceId>crs</ns1:ServiceId><ns1:Major>13</ns1:Major><ns1:Intermediate>0</ns1:Intermediate><ns1:Minor>0</ns1:Minor></ns1:Version><ns1:ReturnTransitAndCommit>true</ns1:ReturnTransitAndCommit><ns1:RequestedShipment>
        <ns1:DropoffType>REGULAR_PICKUP</ns1:DropoffType>
        <ns1:ServiceType>FEDEX_EXPRESS_SAVER</ns1:ServiceType>
        <ns1:PackagingType>YOUR_PACKAGING</ns1:PackagingType>
        <ns1:TotalInsuredValue><ns1:Currency>USD</ns1:Currency></ns1:TotalInsuredValue>
        <ns1:Shipper><ns1:Contact><ns1:PersonName>Sender Name</ns1:PersonName><ns1:CompanyName>Sender Company Name</ns1:CompanyName><ns1:PhoneNumber></ns1:PhoneNumber></ns1:Contact><ns1:Address><ns1:StreetLines></ns1:StreetLines><ns1:City></ns1:City><ns1:StateOrProvinceCode></ns1:StateOrProvinceCode>
        <ns1:PostalCode>'.$request->shipper_postal.'</ns1:PostalCode><ns1:CountryCode>US</ns1:CountryCode></ns1:Address></ns1:Shipper>
        <ns1:Recipient><ns1:Contact><ns1:PersonName>Recipient Name</ns1:PersonName><ns1:CompanyName>Company Name</ns1:CompanyName><ns1:PhoneNumber></ns1:PhoneNumber></ns1:Contact><ns1:Address><ns1:StreetLines></ns1:StreetLines><ns1:City></ns1:City><ns1:StateOrProvinceCode></ns1:StateOrProvinceCode>
        <ns1:PostalCode>'.$request->recipient_postal.'</ns1:PostalCode>
        <ns1:CountryCode>US</ns1:CountryCode><ns1:Residential>false</ns1:Residential></ns1:Address></ns1:Recipient><ns1:ShippingChargesPayment><ns1:PaymentType>SENDER</ns1:PaymentType><ns1:Payor>
        <ns1:ResponsibleParty>
        <ns1:AccountNumber>'.$account_number.'</ns1:AccountNumber>
        </ns1:ResponsibleParty>
        </ns1:Payor></ns1:ShippingChargesPayment>
        <ns1:RateRequestTypes>ACCOUNT</ns1:RateRequestTypes><ns1:PackageCount>1</ns1:PackageCount><ns1:RequestedPackageLineItems><ns1:SequenceNumber>1</ns1:SequenceNumber>
        <ns1:GroupPackageCount>1</ns1:GroupPackageCount>
        <ns1:Weight><ns1:Units>LB</ns1:Units><ns1:Value>20</ns1:Value></ns1:Weight>
        <ns1:Dimensions>
        <ns1:Length>'.$request->length.'</ns1:Length>
        <ns1:Width>'.$request->width.'</ns1:Width>
        <ns1:Height>'.$request->height.'</ns1:Height>
        <ns1:Units>IN</ns1:Units>
        </ns1:Dimensions>
        </ns1:RequestedPackageLineItems>
        </ns1:RequestedShipment></ns1:RateRequest></SOAP-ENV:Body></SOAP-ENV:Envelope>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://wsbeta.fedex.com:443/web-services');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $result_xml = curl_exec($ch);

        // remove colons and dashes to simplify the xml
        $result_xml = str_replace(array(':','-'), '', $result_xml);
        $result = @simplexml_load_string($result_xml);
        // $array_data = json_decode(json_encode(simplexml_load_string($result_xml)), true);
        $array_data = json_decode(json_encode(@simplexml_load_string($result_xml)), true);
        $data = $array_data['SOAPENVBody'];
        $final_data = [];
        if(isset($data['RateReply']['RateReplyDetails']['RatedShipmentDetails']['0']['ShipmentRateDetail'])){
            $final_data['DeliveryStation'] = $data['RateReply']['RateReplyDetails']['DeliveryStation'];
            $final_data['DeliveryDayOfWeek'] = $data['RateReply']['RateReplyDetails']['DeliveryDayOfWeek'];
            $final_data['ServiceType'] = $data['RateReply']['RateReplyDetails']['ServiceType'];
            $data = $data['RateReply']['RateReplyDetails']['RatedShipmentDetails']['0']['ShipmentRateDetail'];
            $final_data['fuel_surcharge'] = $data['FuelSurchargePercent'];
            $final_data['total_freight'] = $data['TotalBaseCharge']['Amount'];
            $final_data['total_fedex_charge'] = $data['TotalNetFedExCharge']['Amount'];
            $final_data['TotalBillingWeightUnits'] = $data['TotalBillingWeight']['Units'];
            $final_data['TotalBillingWeightValue'] = $data['TotalBillingWeight']['Value'];

        }
        // return view('frontend.shipping.shipping-estimation-rates', compact('final_data'));
        return $final_data;


    }

    
}
