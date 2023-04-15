<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $data = [
            "accountNumber" => [
                "value" => "510087100"
            ],
            "requestedShipment" => [
                "shipper" => [
                    "address" => [
                        "postalCode" => $request->S_pincode,
                        "countryCode" => $request->S_country,
                    ]
                ],
                "recipient" => [
                    "address" => [
                        "postalCode" => $request->R_pincode,
                        "countryCode" => $request->R_country,
                    ]
                ],
                "pickupType" => "DROPOFF_AT_FEDEX_LOCATION",
                "rateRequestType" => [
                    "ACCOUNT"
                ],
                "requestedPackageLineItems" => [
                    [
                        "declaredValue" => [
                            "amount" => "100",
                            "currency" => "USD"
                        ],
                        "weight" => [
                            "units" => "LB",
                            "value" => $request->weight
                        ],
                        "dimensions" => [
                            "length" => $request->length,
                            "width" => $request->width,
                            "height" => $request->height,
                            "units" => "IN"
                        ]
                    ]
                ]
            ]
        ];
        // return response()->json($data);
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://apis-sandbox.fedex.com/rate/v1/rates/quotes',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $this->get_token(),
                ),
            )
        );

        $response = curl_exec($curl);
        curl_close($curl);
        return response($response);
    }
}