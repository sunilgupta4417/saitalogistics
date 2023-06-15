<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Common;
use App\Models\{
    Country,
    User,
    PacketBooking,
    ShippingZone
};
use Illuminate\Support\Facades\{
    Artisan,
    Validator,
    Session,
    Hash,
    Auth,
    DB
};

class DashboardController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $data['user'] = User::where(['id' => auth()->user()->id])->first();
        $data['country'] = Country::select('*')->get();
        return view('frontend.dashboard.index', $data);
    }

    public function update_profile(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'mobile' => 'required',
            'file' => 'mimes:jpeg,jpg,png,gif,gif | max:5120',
        );

        $fieldNames = array(
            'name' => 'First Name',
            'mobile' => 'Mobile',
            'file' => "Profile Pic",
        );
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $user = User::where(['id' => Auth::user()->id])->first();
            $user->name = $request->name;
            $user->mobile_no = $request->mobile;
            $user->phn_code = $request->phn_code;
            $picture = $request->file;
            if (isset($picture)) {
                $imageName = time() . '.' . $request->file->extension();

                $ext = strtolower($request->file->extension());

                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp') {
                    $request->file->move(public_path('/assets/images/profile/'), $imageName);
                    $user->profile_pic = $imageName;

                } else {
                    $this->helper->one_time_message('error', 'Invalid Image Format!');
                    return back();
                }
            }
            $user->save();

        }

        $this->helper->one_time_message('success', __('Profile Updated successfully!'));
        return redirect('user/dashboard');

    }


    public function update_password(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = User::where(['id' => Auth::user()->id])->first();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            $this->helper->one_time_message('success', __('Password Updated successfully!'));
            return redirect('user/dashboard');
        } else {
            $this->helper->one_time_message('error', __('Old Password is Wrong!'));
            return redirect('user/dashboard');
        }
    }

    public function get_shipment()
    {
        $data['shipments'] = PacketBooking::where(['client_id' => auth()->user()->id])->get();
        // dd($data['shipments']);
        return view('frontend.dashboard.shipment_history', $data);
    }

    public function create_shipment()
    {
        $data['country'] = ShippingZone::all();
        // $data['user'] = User::where(['id' => auth()->user()->id])->first();
        return view('frontend.dashboard.shipment_create', $data);

    }


    public function create_courier_shipment(){
        $data['user'] = auth()->user();
        return view('frontend.dashboard.shipment_create_courier', $data);

    }
    public function create_air_shipment()
    {
        $data['user'] = auth()->user();
        return view('frontend.dashboard.shipment_create_air', $data);
    }

    public function create_ocean_shipment()
    {
        $data['user'] = auth()->user();
        // $data['user'] = User::where(['id' => auth()->user()->id])->first();
        return view('frontend.dashboard.shipment_create_ocean', $data);
    }

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
    public function store_shipment(Request $request)
    {
        // return response()->json($request->all());
    
        if ($request->S_address_type == 'Default') {
            $S_default = 1;
            $S_residential = 0;
        } else if ($request->S_address_type == 'Residential') {
            $S_default = 0;
            $S_residential = 1;
        } else {
            $S_default = 0;
            $S_residential = 0;
        }
        if ($request->dropPickup == 'cdrop') {
            $cpickup = 0;
            $cdrop = 1;
        } else if ($request->dropPickup == 'cpickup') {
            $cpickup = 1;
            $cdrop = 0;
        } else {
            $cpickup = 0;
            $cdrop = 0;
        }
        $backImg = $frontImg = '';
        if (isset($request->S_idFront)) {
            $picture = $request->S_idFront;
            $ext = strtolower($picture->getClientOriginalExtension());
            $filename = time() . '.' . $ext;
            $dir1 = public_path('/assets/images/profile/' . $filename);
            $frontImg = $filename;
            // if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp')
            // {
            //     $img = Image::make($picture->getRealPath());

            //     $img->resize(100, 100)->save($dir1);

            //   $frontImg = $filename;
            // }
            // else
            // {
            //        $frontImg = '';
            // }
        }
        if (isset($request->S_idBack)) {
            $picture = $request->S_idBack;
            $ext = strtolower($picture->getClientOriginalExtension());
            $filename = time() . '.' . $ext;

            $dir1 = public_path('/assets/images/profile/' . $filename);
            $backImg = $filename;
            // if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp')
            // {
            //     $img = Image::make($picture->getRealPath());

            //     $img->resize(100, 100)->save($dir1);

            //    $backImg = $filename;
            // }
            // else
            // {
            //        $backImg = '';
            // }
        }
        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999) . mt_rand(1000000, 9999999) . $characters[rand(0, strlen($characters) - 1)];
        // shuffle the result
        $string = str_shuffle($pin);

        $shipment = new PacketBooking();
        $shipment->awb_no ="";
        $shipment->reference_no = $string;
        $shipment->booking_date = $request->date;
        $shipment->csr_pan = $request->S_pan;
        $shipment->csr_gstin = $request->S_gstin;
        $shipment->csr_iec = $request->S_iec;
        $shipment->csr_aadharno = $request->S_aadhaar;
        $shipment->client_id = auth()->user()->id;
        $shipment->csr_country_id = $request->S_country;
        $shipment->csr_consignor = $request->S_name;
        $shipment->csr_contact_person = $request->s_mobile_c_code.$request->S_contact;
        $shipment->csr_address1 = $request->S_address;
        $shipment->csr_address2 = $request->S_appartment;
        $shipment->csr_address3 = $request->S_department;
        $shipment->csr_pincode = $request->S_pincode;
        $shipment->csr_city_id = $request->S_city;
        $shipment->S_other = $request->S_other;
        $shipment->S_default = $S_default;
        $shipment->S_residential = $S_residential;
        $shipment->csr_email_id = $request->S_email;
        $shipment->csr_mobile_no = $request->csn_mobile_code.$request->S_phone;
        $shipment->S_idProof = $request->S_idProof;
        $shipment->S_idFront = $frontImg;
        $shipment->S_idBack = $backImg;
        $shipment->csn_country_id = $request->R_country;
        $shipment->csn_consignor = $request->R_name;
        $shipment->csn_contact_person = $request->csn_contact_person_code.$request->R_contact;
        $shipment->csn_address1 = $request->R_address;
        $shipment->csn_address2 = $request->R_appartment;
        $shipment->csn_address3 = $request->R_department;
        $shipment->csn_pincode = $request->R_pincode;
        $shipment->csn_city_id = $request->R_city;
        $shipment->csn_tan_number = $request->R_tan;
        $shipment->R_other = $request->R_other;
        $shipment->csn_email_id = $request->R_email;
        $shipment->csn_mobile_no = $request->csr_mobile_code.$request->R_phone;
        $shipment->courier_type = $request->courier_type;
        $shipment->pcs_weight = $request->weight;
        $shipment->chargeable_weight = $request->chargeable_weight;
        $shipment->length = $request->length;
        $shipment->width = $request->width;
        $shipment->height = $request->height;
        $shipment->actual_weight = $request->actual_weight;
        $shipment->dvalue = $request->dvalue;
        $shipment->packet_type = $request->package_type;
        $shipment->shipping_charge = $request->shipping_charge;
        $shipment->cpickup = $cpickup;
        $shipment->cdrop = $cdrop;
        $shipment->dpDate = $request->date;
        $shipment->payment_gateway = 'none';
        $shipment->payment_status = 'pending';

        $shipment->csr_state_id = $request->S_state;
        $shipment->csn_state_id = $request->R_state;
        $shipment->pcs_weight = $request->weight;
        $shipment->length = $request->length;
        $shipment->width = $request->width;
        $shipment->dvalue = $request->dvalue;
        $shipment->shipping_charge = $request->shipping_charge;

        $shipment->save();
        $responseData = array(
            'id' => $shipment->id,
            'user_email' => $shipment->csr_email_id,
            'client_id' => $shipment->client_id,
            'shipping_charge' => $shipment->shipping_charge,
            'tax' => 0,
            'total' => $shipment->shipping_charge
        );
        return response()->json($responseData);
    }

    public function store_shipment_payment(Request $request)
    {
        $payment_gateway=isset($request->payment_gateway)?$request->payment_gateway:"Epay";
        $payment_type=isset($request->payment_type)?$request->payment_type:"online";
        if(($request->status=="ok") && ($request->response["transt"]=="completed")){
            PacketBooking::where("id",$request->id)->update(["payment_gateway"=>$payment_gateway,"payment_status"=>"success","payment_type"=>$payment_type,"payment_response"=>$request->response,"booking_status"=>4]);
        }else{
            PacketBooking::where("id",$request->id)->update(["payment_gateway"=>$payment_gateway,"payment_status"=>"failed","payment_type"=>$payment_type,"payment_response"=>$request->response]);
        }
        /** Send order on email */
        $packetInfo=PacketBooking::where("id",$request->id)->get()->first();
        if(!empty($packetInfo)){
            $orderData['name']=$packetInfo->csr_consignor;
            $orderData['receipt_reference_no']=$packetInfo->id;
            $orderData['account_id']=$packetInfo->client_id;
            $orderData['awb_no']=$packetInfo->awb_no;
            $orderData['reference_no']=$packetInfo->reference_no;
            $orderData['amount']=$packetInfo->shipping_charge;
            $orderData['payment_status']=($packetInfo->payment_status=="success"?"Success":"Rejected");
            $orderData['payment_date']=date("Y-m-d h:i:s", strtotime($packetInfo->created_at));
            $orderData['payment_mode']=$packetInfo->payment_gateway;
            $orderData['customer_name']=$packetInfo->csr_consignor;
            $orderData['email']=$packetInfo->csr_email_id;
            $emailContent=array(
                "subject"=>"Shipment Created From Saita Logistics",
                "email_template"=>"emails.shipment-details",
                "email_content"=>($orderData)
            );
            $emailStatus=sendMyEmail($orderData['email'],$emailContent);
        }
        
        $responseData = array(
            'id' => $request->id,
            'status' => $request->status,
            'response' => $request->response,
            'redirect_url' => route('user.shipping.success',encryptToBase64($packetInfo->id))
        );
        return response()->json($responseData);
    }
    public function createNewShipment(Request $request){
        // return response()->json($request->all());
        $requestData=$request->all();
        $awbNumber=generateRandomString();
        $shipment = new PacketBooking();
        $shipment->awb_no ="";
        $shipment->reference_no =$awbNumber;
        $shipment->client_id = auth()->user()->id;
        $ignoreKeys=array("_token","cpickup","csr_address1_type","S_idFront","S_idBack","attach_package_list","term_conditions","weight");
        foreach($requestData as $key=>$requestValue){
            if(!in_array($key,$ignoreKeys)){
                if(!empty($requestValue)){ 
                    $shipment->$key=$requestValue;
                }else{
                    $shipment->$key="";
                }
            }
            if($key=="booking_date"){
                $shipment->dpDate=$requestValue;
            }
            if($key=="cpickup"){
                $shipment->cpickup=($requestValue=="PICKUP")?1:0;
                $shipment->cdrop=($requestValue=="DROPOFF")?1:0;
            }
            if($key=="shipping_charge"){
                $shipment->total_charges=$shipment->shipping_charge;
            }
            if($key=="csr_address1_type"){
                $shipment->S_default=($requestValue=="Default")?1:0;
                $shipment->S_residential=($requestValue=="Residential")?1:0;
            }
            if($key=="S_idFront"){
                $imageName = "f".time().'.'.$requestValue->extension();
                $requestValue->move(public_path('logistics/reference_files/'), $imageName);
                $shipment->$key=$imageName;
            }
            if($key=="S_idBack"){
                $imageName = "b".time().'.'.$requestValue->extension();
                $requestValue->move(public_path('logistics/reference_files/'), $imageName);
                $shipment->$key=$imageName;
            }
            if($key=="attach_package_list"){
                $imageName = "pl".time().'.'.$requestValue->extension();
                $requestValue->move(public_path('logistics/reference_files/'), $imageName);
                $shipment->$key=$imageName;
            }
        }
        $shipment->payment_gateway = 'none';
        $shipment->payment_status = 'pending';
        //mydd($shipment);
        $shipment->save();
        /**Send Email To Customer */
        if(!empty($shipment)){
            $orderData['name']=$shipment->csr_consignor_person?$shipment->csr_consignor_person:$shipment->csr_consignor;
            $orderData['origin']=$shipment->csr_country_id?getCountries($shipment->csr_country_id):"";
            $orderData['destination']=$shipment->csn_country_id?getCountries($shipment->csn_country_id):"";
            $orderData['booking_date']=$shipment->booking_date?date("Y-m-d h:i:s",strtotime($shipment->booking_date)):"";
            $orderData['email']=$shipment->csr_email_id;
            if(!empty($shipment->courier_type) && ($shipment->courier_type=="courier")){
                $orderData['subject']="Courier shipment created";
                $orderData['email_template']="emails.shipments.couirer_order_to_customer";
            }elseif(!empty($shipment->courier_type) && ($shipment->courier_type=="air")){
                $orderData['subject']="Air freight shipment created";
                $orderData['email_template']="emails.shipments.air_freight_order_to_customer";
                $orderData['weight']=$shipment->pcs_weight?$shipment->pcs_weight:"";
            }elseif(!empty($shipment->courier_type) && ($shipment->courier_type=="ocean")){
                $orderData['subject']="Ocean freight shipment created";
                $orderData['email_template']="emails.shipments.ocean_freight_order_to_customer";
                $orderData['container_type']=$shipment->container_type?$shipment->container_type:"";
            }
            $emailContent=array(
                "subject"=>$orderData['subject'],
                "email_template"=>$orderData['email_template'],
                "email_content"=>($orderData)
            );
            $emailStatus=sendMyEmail($orderData['email'],$emailContent);
        }
        $responseData = array(
            'id' => $shipment->id,
            'user_email' => $shipment->csr_email_id,
            'client_id' => $shipment->client_id
        );
        return response()->json($responseData);  
    }
    
    public function createShipmentPayment($shipment_id="")
    {
        if(!empty($shipment_id)){
            $data['encrypt_shipment_id']=$shipment_id;
            $shipment_id=decryptFromBase64($shipment_id);
            $shipments = PacketBooking::find($shipment_id);
            if(!empty($shipments)){
                $shipments=$shipments->toArray();
                $data['shipments']=$shipments;
            }
        }
        $data['user'] =auth()->user();
        return view('frontend.dashboard.shipment_payment', $data);
    }
    
    public function shipping_success($shipment_id="")
    {
        if(!empty($shipment_id)){
            $shipment_id=decryptFromBase64($shipment_id);
            $shipments = PacketBooking::find($shipment_id);
            if(!empty($shipments)){
                $shipments=$shipments->toArray();
                $data['shipments']=$shipments;
            }
        }
        $data['user'] =auth()->user();
        return view('frontend.dashboard.shipment_success', $data);

    }
    
    public function acceptShipmentQuote($shipment_id="")
    {
        if(!empty($shipment_id)){
            $shipment_id=decryptFromBase64($shipment_id);
            $packetInfo = PacketBooking::where('id',$shipment_id)->get()->first();
            if(!empty($packetInfo)){
                $packetInfo=$packetInfo->toArray();
                $orderData['name']=$packetInfo['csr_consignor_person']?$packetInfo['csr_consignor_person']:$packetInfo['csr_consignor'];
                $orderData['email']=$packetInfo['csr_email_id'];
                $orderData['subject']="Quotation accepted by customer";
                $orderData['email_template']="emails.shipments.order_quotation_acceptance_to_customer";
                $emailContent=array(
                    "subject"=>$orderData['subject'],
                    "email_template"=>$orderData['email_template'],
                    "email_content"=>($orderData)
                );
                $emailStatus=sendMyEmail($orderData['email'],$emailContent);
                if(!empty($emailStatus)){
                    $packetObj=PacketBooking::find($packetInfo['id']);
                    $packetObj->booking_status=2;
                    $packetObj->save();
                    $message="Quotation accepted successfully";
                    return redirect(route('user.get_shipment'))->with('success',$message);
                }else{
                    $message="Quotation not accepted, please contact our support";
                    return redirect(route('user.get_shipment'))->with('error',$message);
                }
            }
        }
        $message="Quotation not accepted, please contact our support";
        return redirect(route('user.get_shipment'))->with('error',$message);
    }
    
    public function getTransactions()
    {
        $data['transactions'] = PacketBooking::where(['client_id' => auth()->user()->id])->get();
        // dd($data['transactions']);
        return view('frontend.dashboard.shipment_transactions', $data);
    }



}