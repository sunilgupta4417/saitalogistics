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
        $requestedWeight=isset($request->weight)?floatval($request->weight):0;
        $package_type=isset($request->package_type)?trim($request->package_type):"";
        $R_country=isset($request->R_country)?intval($request->R_country):1;
        $count = ShippingZone::find($R_country);
        $DHLzone = ZoneRate::select("id","package_type","carrier_type","weight","rate")->where("package_type",$package_type)->where("carrier_type","DHL")->where("weight",">=",$requestedWeight)->orderBy("id","ASC")->first();
        //mydd($DHLzone->toArray()); 
        if (empty($DHLzone)) {
            $max_W = ZoneRate::where('package_type', $package_type)->where('carrier_type', 'DHL')->max('weight');
            $res['warning'] = 'maximum weight ' . $max_W . ' allowed for DHL ' . $package_type;
        }
        if (isset($DHLzone->rate)) {
            $DHLdata = json_decode($DHLzone->rate, true);
            if (isset($DHLdata['ZONE_' . $count->dhl_zone])) {
                $res['DHL']['rate'] = $DHLdata['ZONE_' . $count->dhl_zone];
                $res['DHL']['zone'] = $count->dhl_zone;
            } else {
                $res['DHL']['rate'] = 'NIL';
                $res['DHL']['zone'] = 'NIL';
            }
        } else {
            $res['DHL']['rate'] = 'NIL';
            $res['DHL']['zone'] = 'NIL';
        }
        if (isset($DPDzone->rate)) {
            $DPDdata = json_decode($DPDzone->rate, true);
            if (isset($DPDdata['ZONE_' . $count->dpd_zone])) {
                $res['DPD']['rate'] = $DPDdata['ZONE_' . $count->dpd_zone];
                $res['DPD']['zone'] = $count->dpd_zone;
            } else {
                $res['DPD']['rate'] = 'NIL';
                $res['DPD']['zone'] = 'NIL';
            }
        } else {
            $res['DPD']['rate'] = 'NIL';
            $res['DPD']['zone'] = 'NIL';
        }

        asort($res);
        array_reverse($res);
        $numeric_rates = array_filter(array_column($res, 'rate'), 'is_numeric');
        if (empty($numeric_rates)) {
            return response()->json(['error' => 'Somethig is wrong, please try to change package type or connect customer support']);
        } else {
            $max_rate = max($numeric_rates);
            return response()->json(['rate' => $max_rate]);
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
//                     "countryCode" => $request->R_country,
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