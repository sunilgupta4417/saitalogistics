<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ShippingZone, ZoneRate};
class ShippingController extends Controller
{
    public function get_token()
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://apis-sandbox.fedex.com/oauth/token',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=' . env('FEDEX_ACCOUNT_APP_KEY') . '&client_secret=' . env('FEDEX_ACCOUNT_SECRET'),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                ),
            )
        );

        $response = curl_exec($curl);
        curl_close($curl);
        $JSOND = json_decode($response, true);
        return $JSOND['access_token'];
    }
    public function getRates(Request $request)
    {
        $res = [];
        //mydd($request->all());
        $package_type=isset($request->package_type)?trim($request->package_type):"";
        $requestedWeight=isset($request->weight)?floatval($request->weight):0;
        $to_country=isset($request->to_country)?intval($request->to_country):1;
        $from_country=isset($request->from_country)?intval($request->from_country):235;
        $toCountryInfo = ShippingZone::find($to_country);
        $ratesErrorWarning="";
        if($from_country==235){
            $DHLzone = ZoneRate::select("id","package_type","carrier_type","weight","rate")->where("package_type",$package_type)->where("carrier_type","DHL")->where("weight",">=",$requestedWeight)->where("base_country_id",$from_country)->orderBy("id","ASC")->first();
            //mydd($DHLzone->toArray()); 
            if (empty($DHLzone)) {
                $max_W = ZoneRate::where('package_type', $package_type)->where('carrier_type', 'DHL')->max('weight');
                $ratesErrorWarning = 'Maximum weight ' . $max_W . 'kg allowed for '.$package_type;
            }else{
                if (isset($DHLzone->rate) && isset($toCountryInfo->dhl_zone)) {
                    $DHLdata = json_decode($DHLzone->rate, true);
                    if (isset($DHLdata['ZONE_'.$toCountryInfo->dhl_zone])) {
                        $res['DHL']['rate'] = $DHLdata['ZONE_'.$toCountryInfo->dhl_zone];
                        $res['DHL']['zone'] = $toCountryInfo->dhl_zone;
                    }else{
                        $ratesErrorWarning = 'Sorry we don\'t have rates realted to your package';
                    }
                }else{
                    $ratesErrorWarning = 'Sorry we don\'t have rates realted to your package';
                }
            }
            if (isset($DPDzone->rate) && isset($toCountryInfo->dhl_zone)) {
                $DPDdata = json_decode($DPDzone->rate, true);
                if (isset($DPDdata['ZONE_' . $$toCountryInfo->dpd_zone])) {
                    $res['DPD']['rate'] = $DPDdata['ZONE_' . $$toCountryInfo->dpd_zone];
                    $res['DPD']['zone'] = $$toCountryInfo->dpd_zone;
                }/*else{
                    $ratesErrorWarning = 'Sorry we don\'t have rates realted to your package';
                }*/
            }/*else{
                $ratesErrorWarning = 'Sorry we don\'t have rates realted to your package';
            }*/
        }else{
            $carrierType="HKC";
            $ratesInfo = ZoneRate::select("id","package_type","carrier_type","weight","rate")->where("package_type",$package_type)->where("carrier_type",$carrierType)->where("weight",">=",$requestedWeight)->where("base_country_id",$from_country)->orderBy("id","ASC")->first();
            /*mydd($ratesInfo);*/
            if (empty($ratesInfo)) {
                $max_W = ZoneRate::where('package_type', $package_type)->where('carrier_type',$carrierType)->max('weight');
                $ratesErrorWarning = 'Maximum weight ' . $max_W . 'kg allowed for '. $package_type;
            }else{
                if (isset($ratesInfo->rate)) {
                    $ratesData = json_decode($ratesInfo->rate, true);
                    $counrtyName=strtolower(str_replace(" ","_",$toCountryInfo->country));
                    if (isset($ratesData[$counrtyName])) {
                        $res[$carrierType]['rate'] = $ratesData[$counrtyName];
                        $res[$carrierType]['zone'] = $counrtyName;
                    }else{
                        $ratesErrorWarning = 'Sorry we don\'t have rates realted to your package';
                    }
                }else{
                    $weightWarning = 'Sorry we don\'t have rates realted to your package';
                }
            }
        }
        if(!empty($ratesErrorWarning)){
            return response()->json(['error' => $ratesErrorWarning.', please try to change package type or connect customer support']);
        }else{
            asort($res);
            array_reverse($res);
            $numeric_rates = array_filter(array_column($res, 'rate'), 'is_numeric');
            if (empty($numeric_rates)) {
                return response()->json(['error' => 'Somethig is wrong, please try to change package type or connect customer support']);
            } else {
                $max_rate = max($numeric_rates);
                if($from_country==235){
                    $max_rate=round(($max_rate*1.2),2);
                }else{
                    $max_rate=round(($max_rate/7.8),2);
                }
                return response()->json(['rate' => $max_rate]);
            }
        }
    }
// public function getRates(Request $request)
// {
//     $data = [
//         "accountNumber" => [
//             "value" => "510087100"
//         ],
//         "requestedShipment" => [
//             "shipper" => [
//                 "address" => [
//                     "postalCode" => $request->S_pincode,
//                     "countryCode" => $request->S_country,
//                 ]
//             ],
//             "recipient" => [
//                 "address" => [
//                     "postalCode" => $request->R_pincode,
//                     "countryCode" => $request->to_country,
//                 ]
//             ],
//             "pickupType" => "DROPOFF_AT_FEDEX_LOCATION",
//             "rateRequestType" => [
//                 "ACCOUNT"
//             ],
//             "requestedPackageLineItems" => [
//                 [
//                     "declaredValue" => [
//                         "amount" => "100",
//                         "currency" => "USD"
//                     ],
//                     "weight" => [
//                         "units" => "LB",
//                         "value" => $request->weight
//                     ],
//                     "dimensions" => [
//                         "length" => $request->length,
//                         "width" => $request->width,
//                         "height" => $request->height,
//                         "units" => "IN"
//                     ]
//                 ]
//             ]
//         ]
//     ];
//     // return response()->json($data);
//     $curl = curl_init();

//     curl_setopt_array(
//         $curl,
//         array(
//             CURLOPT_URL => 'https://apis-sandbox.fedex.com/rate/v1/rates/quotes',
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => '',
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 0,
//             CURLOPT_FOLLOWLOCATION => true,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => 'POST',
//             CURLOPT_POSTFIELDS => json_encode($data),
//             CURLOPT_HTTPHEADER => array(
//                 'Content-Type: application/json',
//                 'Authorization: Bearer ' . $this->get_token(),
//             ),
//         )
//     );

//     $response = curl_exec($curl);
//     curl_close($curl);
//     return response($response);
// }
}