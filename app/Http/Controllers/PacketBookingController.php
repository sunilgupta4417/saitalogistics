<?php

namespace App\Http\Controllers;

use App\Models\PacketBooking;
use App\Models\ClientMaster;
use App\Models\VendorMaster;
use App\Models\Country;
use App\Models\ShippingZone;
use App\Models\ZoneRate;
use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PacketBookingController extends Controller
{
    public function packetBooking(Request $request){
        $client = ClientMaster::select('id','client_name')->whereNull('deleted_at')->get();
        $country = Country::select('id','country_name','country_code')->where('isActive',1)->get();
        return view('packet.packet_booking',compact('client','country'));
    }

    public function savePacketBooking(Request $request){
        $this->validate($request,[
            'awb_no'=>'required',
            'ref_no'=>'required',
            'booking_date'=>'required',
            // 'client_id'=>'required',
            'consignor' =>'required',
            'consignor_c_person' =>'required',
            'consignor_address_1' =>'required',
            'consignor_address_2' =>'required',
            'consignor_address_3' =>'required',
            'consignor_pin_code' =>'required',
            'consignor_country' =>'required',
            'consignor_state' =>'required',
            'consignor_city' =>'required',
            'consignor_mobile' => 'required',
            'consignor_email' => 'required',
            'consignee' => 'required',
            'consignee_cname' => 'required',
            'consignee_address_1' => 'required',
            'consignee_address_2' => 'required',
            'consignee_address_3' => 'required',
            'consignee_pincode' => 'required',
            'consignee_country' => 'required',
            'consignee_state' => 'required',
            'consignee_city' => 'required',
            'consignee_mobile' => 'required',
            'consignee_email' => 'required',
            'packet_type' => 'required',
            'payment_type' => 'required',
            'pcs_weight' => 'required',
            'chargeable_weight' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'dvalue' => 'required',
            'shipping_charge' => 'required',
            // 'total_value' => 'required',
            // 'ddlCurrencyType' => 'required',
            // 'divisor' => 'required',
            'accounting_remark' => 'required',
            'accounting_remark' => 'required',
         ]);
        $data = [
            'awb_no' => isset($request->awb_no) ? $request->awb_no : null,
            'reference_no' => isset($request->ref_no) ? $request->ref_no : null,
            'booking_date' => isset($request->booking_date) ? $request->booking_date : null,
            // 'client_id' => isset($request->client_id) ? $request->client_id : null,
            'csr_consignor' => isset($request->consignor) ? $request->consignor : null,
            'csr_contact_person' => isset($request->consignor_c_person) ? $request->consignor_c_person : null,
            'csr_address1' => isset($request->consignor_address_1) ? $request->consignor_address_1 : null,
            'csr_address2' => isset($request->consignor_address_2) ? $request->consignor_address_2 : null,
            'csr_address3' => isset($request->consignor_address_3) ? $request->consignor_address_3 : null,
            'csr_pincode' => isset($request->consignor_pin_code) ? $request->consignor_pin_code : null,
            'csr_country_id' => isset($request->consignor_country) ? $request->consignor_country : null,
            'csr_state_id' => isset($request->consignor_state) ? $request->consignor_state : null,
            'csr_city_id' => isset($request->consignor_city) ? $request->consignor_city : null,
            'csr_mobile_no' => isset($request->consignor_mobile) ? $request->consignor_mobile : null,
            'csr_email_id' => isset($request->consignor_email) ? $request->consignor_email : null,
            'csr_pan' => isset($request->consignor_pan) ? $request->consignor_pan : null,
            'csr_gstin' => isset($request->consignor_gstin) ? $request->consignor_gstin : null,
            'csr_iec' => isset($request->consignor_IEC) ? $request->consignor_IEC : null,
            'csr_aadharno' => isset($request->consignor_aadhaar_no) ? $request->consignor_aadhaar_no : null,
            'csn_consignor' => isset($request->consignee) ? $request->consignee : null,
            'csn_contact_person' => isset($request->consignee_cname) ? $request->consignee_cname : null,
            'csn_address1' => isset($request->consignee_address_1) ? $request->consignee_address_1 : null,
            'csn_address2' => isset($request->consignee_address_2) ? $request->consignee_address_2 : null,
            'csn_address3' => isset($request->consignee_address_3) ? $request->consignee_address_3 : null,
            'csn_pincode' => isset($request->consignee_pincode) ? $request->consignee_pincode : null,
            'csn_country_id' => isset($request->consignee_country) ? $request->consignee_country : null,
            'csn_state_id' => isset($request->consignee_state) ? $request->consignee_state : null,
            'csn_city_id' => isset($request->consignee_city) ? $request->consignee_city : null,
            'csn_mobile_no' => isset($request->consignee_mobile) ? $request->consignee_mobile : null,
            'csn_email_id' => isset($request->consignee_email) ? $request->consignee_email : null,
            'csn_tan_number' => isset($request->consignee_tan) ? $request->consignee_tan : null,
            'packet_type' => isset($request->packet_type) ? $request->packet_type : null,
            'payment_type' => isset($request->payment_type) ? $request->payment_type : null,
            'invoice_no' => isset($request->invoice_no) ? $request->invoice_no : null,
            'packet_description' => isset($request->packet_detail) ? $request->packet_detail : null,
            // 'pcs_weight' => isset($request->pcs) ? $request->pcs : null,
            'actual_weight' => isset($request->actual_weight) ? $request->actual_weight : null,
            'vendor_weight' => isset($request->vendor_weight) ? $request->vendor_weight : null,
            'vendor_weight_type' => isset($request->vendor_packet_type) ? $request->vendor_packet_type : null,
            'total_weight' => isset($request->total_value) ? $request->total_value : null,
            'currency' => isset($request->ddlCurrencyType) ? $request->ddlCurrencyType : null,
            'devisor' => isset($request->divisor) ? $request->divisor : null,
            'operation_remark' => isset($request->operation_remark) ? $request->operation_remark : null,
            'accounting_remark' => isset($request->accounting_remark) ? $request->accounting_remark : null,
            'created_by' => auth()->user()->id,
            'pcs_weight' => isset($request->pcs_weight) ? $request->pcs_weight : null,
            'chargeable_weight' => isset($request->chargeable_weight) ? $request->chargeable_weight : null,
            'length' => isset($request->length) ? $request->length : null,
            'width' => isset($request->width) ? $request->width : null,
            'height' => isset($request->height) ? $request->height : null,
            'dvalue' => isset($request->dvalue) ? $request->dvalue : null,
            'shipping_charge' => isset($request->shipping_charge) ? $request->shipping_charge : null,
        ];

        if($request->hasFile('invoice_document')) {
            $destinationPath = 'logistics/invoice_document/';
            $invoice_document = public_path($destinationPath);
            if (file_exists($invoice_document)) {
                @unlink($invoice_document);
            }
            $image_name = 'invoice_'.time().'.';
            $myimage = $image_name.$request->invoice_document->getClientOriginalExtension();
            $request->invoice_document->move(public_path($destinationPath), $myimage);
            $data['invoice_doc'] = $myimage; 
        }

        if($request->id == 0){
            $result = PacketBooking::create($data);
            $msg = "Packet Booking Created Successfully";
        }else{
            $result = PacketBooking::where('id',$request->id)->update($data);
            $msg = "Packet Booking Update Successfully";
        }
            
        if($result){
            return redirect()->back()->with('success',$msg);
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }
    public function packetListing(Request $request,$courier_type=""){
        $var = '';
        $client = ClientMaster::select('client_name','id')->get();
        //mydd($request->all());
        $vendor = VendorMaster::select('name','id')->get();
        $client_id = isset($request->client_id) ? $request->client_id : 0;
        $vendor_id= isset($request->vendor) ? $request->vendor : 0;
        $consignee = isset($request->consignee) ? $request->consignee : NULL;
        $startdate =isset($request->startdate) ? date("Y-m-d",strtotime($request->startdate)) : NULL;
        $enddate =isset($request->enddate) ? date("Y-m-d",strtotime($request->enddate)) : NULL;
        $awb_no = isset($request->awb_no) ? $request->awb_no : NULL;
        $booking_status = isset($request->booking_status) ? $request->booking_status : NULL;
        $destination = isset($request->destination) ? $request->destination : NULL;
        $consignor = isset($request->consignor) ? $request->consignor : NULL;
        $forwarding_no = isset($request->forwarding_no) ? $request->forwarding_no : NULL;
        $csr_mobile= isset($request->csr_mobile) ? $request->csr_mobile : NULL;
        $courierType= isset($request->courier_type) ? $request->courier_type : $courier_type;
        $packetBook = PacketBooking::leftjoin('client_masters','client_masters.id','=','packet_bookings.client_id')
        ->select('packet_bookings.*','client_masters.client_name')
        ->where(function ($sqlAdd) use ($startdate,$enddate){
            if($startdate!=NULL && $enddate!=NULL){
                /*$sqlAdd->where('booking_date','>=',$startdate)
                ->where('booking_date','<=',$enddate);*/
                $sqlAdd->whereBetween('booking_date', [$startdate, $enddate]);
            }elseif($startdate!=NULL){
                $sqlAdd->where('booking_date','>=',$startdate);
            }elseif($enddate!=NULL){
                $sqlAdd->where('booking_date','<=',$enddate);
            }
        })
        ->where(function ($sqlAdd) use ($client_id,$vendor_id){
            if($client_id!=0){
                $sqlAdd->where('client_id',$client_id);
            }
        });       
        if(!empty($courierType)){
            $packetBook =$packetBook->where(function ($sqlAdd) use ($courierType){
                if($courierType!=0){
                    $sqlAdd->where('courier_type',$courierType);
                }
            });
        }
        $packetBook=$packetBook->where(function ($sqlAdd) use ($consignee,$booking_status,$destination,$consignor,$forwarding_no,$csr_mobile){
            if($consignee!=NULL){
                $sqlAdd->where('csn_consignor','LIKE','%'.$consignee.'%');
            }
            if($consignor!=NULL){
                $sqlAdd->where('csr_consignor','LIKE','%'.$consignor.'%');
            }
            if($csr_mobile!=NULL){
                $sqlAdd->where('csr_mobile_no',$csr_mobile);
            }
        })
        ->where(function ($sqlAdd) use ($awb_no){
            if($awb_no!=NULL){
                $array = explode(',', $awb_no);
                $sqlAdd->whereIn('awb_no',$array);
            }
        })
        ->paginate(env('page_default_val'));
        return view('packet.packet_list',compact('vendor','client','packetBook'));
    }

    public function packetView(Request $request,$id){
        $packet = PacketBooking::leftjoin('client_masters','client_masters.id','=','packet_bookings.client_id')
        ->select('packet_bookings.*','client_masters.client_name')
        ->where('packet_bookings.id',$id)->first();
        return view('packet.packet_view',compact('packet'));
    }

    public function packetListingExpo(Request $request,$courier_type=""){
        $var = '';
        $client_id = isset($request->client_id) ? $request->client_id : 0;
        $vendor_id= isset($request->vendor) ? $request->vendor : 0;
        $consignee = isset($request->consignee) ? $request->consignee : NULL;
        $startdate =isset($request->startdate) ? date("Y-m-d",strtotime($request->startdate)) : NULL;
        $enddate =isset($request->enddate) ? date("Y-m-d",strtotime($request->enddate)) : NULL;
        $awb_no = isset($request->awb_no) ? $request->awb_no : NULL;
        $booking_status = isset($request->booking_status) ? $request->booking_status : NULL;
        $destination = isset($request->destination) ? $request->destination : NULL;
        $consignor = isset($request->consignor) ? $request->consignor : NULL;
        $forwarding_no = isset($request->forwarding_no) ? $request->forwarding_no : NULL;
        $csr_mobile= isset($request->csr_mobile) ? $request->csr_mobile : NULL;
        if(in_array($courier_type,getCourierTypes())){
            $courierType= isset($request->courier_type) ? $request->courier_type : $courier_type;
        }else{
            $courierType= isset($request->courier_type) ? $request->courier_type :NULL;
        }          
        $packetBook = PacketBooking::leftjoin('client_masters','client_masters.id','=','packet_bookings.client_id');
        if(!empty($courierType)){
            if($courierType=="courier"){
                $packetBook=$packetBook->select("packet_bookings.id","packet_bookings.uuid","packet_bookings.awb_no",
                    "packet_bookings.reference_no","packet_bookings.booking_date","packet_bookings.client_id","packet_bookings.csr_consignor","packet_bookings.csr_contact_person_code","packet_bookings.csr_contact_person","packet_bookings.csr_address1","packet_bookings.csr_address2","packet_bookings.csr_address3","packet_bookings.csr_pincode","packet_bookings.csr_country_id","packet_bookings.csr_state_id","packet_bookings.csr_city_id","packet_bookings.csr_mobile_code","packet_bookings.csr_mobile_no","packet_bookings.S_idProof as kyc_document","packet_bookings.csr_email_id","packet_bookings.csr_pan","packet_bookings.csr_gstin as vat","packet_bookings.csr_iec","packet_bookings.csn_consignor","packet_bookings.csn_contact_person_code","packet_bookings.csn_contact_person","packet_bookings.csn_address1","packet_bookings.csn_address2","packet_bookings.csn_address3","packet_bookings.csn_pincode","packet_bookings.csn_country_id","packet_bookings.csn_state_id","packet_bookings.csn_city_id","packet_bookings.csn_tan_number","packet_bookings.R_other as csn_landmark","packet_bookings.S_other as csr_landmark","packet_bookings.S_default as default_address","packet_bookings.S_residential as residential_address","packet_bookings.csn_mobile_code","packet_bookings.csn_mobile_no","packet_bookings.courier_type","packet_bookings.csn_email_id","packet_bookings.packet_type","packet_bookings.shipping_charge","packet_bookings.fca_charge","packet_bookings.ex_work_charge","packet_bookings.total_charges","packet_bookings.cpickup as pickup","packet_bookings.cdrop as drop","packet_bookings.payment_gateway","packet_bookings.payment_status","packet_bookings.payment_type","packet_bookings.payment_response","packet_bookings.invoice_no","packet_bookings.packet_description","packet_bookings.pcs_weight as weight","packet_bookings.chargeable_weight","packet_bookings.operation_remark","packet_bookings.accounting_remark","client_masters.client_name"
                );
            }elseif($courierType=="air"){
                $packetBook=$packetBook->select("packet_bookings.id","packet_bookings.courier_type","packet_bookings.uuid","packet_bookings.awb_no","packet_bookings.reference_no","packet_bookings.booking_date","packet_bookings.client_id","packet_bookings.csr_consignor","packet_bookings.csr_contact_person_code","packet_bookings.csr_contact_person","packet_bookings.csr_address1","packet_bookings.csr_address2","packet_bookings.csr_address3","packet_bookings.csr_pincode","packet_bookings.csr_country_id","packet_bookings.csr_state_id","packet_bookings.csr_city_id","packet_bookings.csr_mobile_code","packet_bookings.csr_mobile_no","packet_bookings.S_idProof as kyc_document","packet_bookings.csr_email_id","packet_bookings.csr_pan","packet_bookings.csr_gstin as vat","packet_bookings.csr_iec","packet_bookings.csn_consignor","packet_bookings.csn_contact_person_code","packet_bookings.csn_contact_person","packet_bookings.csn_address1","packet_bookings.csn_address2","packet_bookings.csn_address3","packet_bookings.csn_pincode","packet_bookings.csn_country_id","packet_bookings.csn_state_id","packet_bookings.csn_city_id","packet_bookings.csn_tan_number","packet_bookings.R_other as csn_landmark","packet_bookings.S_other as csr_landmark","packet_bookings.S_default as default_address","packet_bookings.S_residential as residential_address","packet_bookings.csn_mobile_code","packet_bookings.csn_mobile_no","packet_bookings.csn_iec_number","packet_bookings.csn_bn_number","packet_bookings.csn_tan_number","packet_bookings.no_of_package","packet_bookings.csn_email_id","packet_bookings.packet_type","packet_bookings.shipping_charge","packet_bookings.fca_charge","packet_bookings.ex_work_charge","packet_bookings.total_charges","packet_bookings.cpickup as pickup","packet_bookings.cdrop as drop","packet_bookings.payment_gateway","packet_bookings.payment_status","packet_bookings.payment_type","packet_bookings.payment_response","packet_bookings.invoice_no","packet_bookings.packet_description","packet_bookings.pcs_weight as weight","packet_bookings.chargeable_weight","packet_bookings.operation_remark","packet_bookings.accounting_remark","client_masters.client_name"
                );
            }elseif($courierType=="ocean"){
                $packetBook=$packetBook->select("packet_bookings.id","packet_bookings.courier_type","packet_bookings.uuid","packet_bookings.awb_no","packet_bookings.reference_no","packet_bookings.booking_date","packet_bookings.client_id","packet_bookings.csr_consignor","packet_bookings.csr_contact_person_code","packet_bookings.csr_contact_person","packet_bookings.csr_address1","packet_bookings.csr_address2","packet_bookings.csr_address3","packet_bookings.csr_pincode","packet_bookings.csr_country_id","packet_bookings.csr_state_id","packet_bookings.csr_city_id","packet_bookings.csr_mobile_code","packet_bookings.csr_mobile_no","packet_bookings.S_idProof as kyc_document","packet_bookings.csr_email_id","packet_bookings.csr_pan","packet_bookings.csr_gstin as vat","packet_bookings.csr_iec","packet_bookings.csn_consignor","packet_bookings.csn_contact_person_code","packet_bookings.csn_contact_person","packet_bookings.csn_address1","packet_bookings.csn_address2","packet_bookings.csn_address3","packet_bookings.csn_pincode","packet_bookings.csn_country_id","packet_bookings.csn_state_id","packet_bookings.csn_city_id","packet_bookings.csn_tan_number","packet_bookings.R_other as csn_landmark","packet_bookings.S_other as csr_landmark","packet_bookings.S_default as default_address","packet_bookings.S_residential as residential_address","packet_bookings.csn_mobile_code","packet_bookings.csn_mobile_no","packet_bookings.csn_iec_number","packet_bookings.csn_bn_number","packet_bookings.csn_tan_number","packet_bookings.no_of_package","packet_bookings.container_type","packet_bookings.commodity","packet_bookings.commodity_type","packet_bookings.csn_email_id","packet_bookings.packet_type","packet_bookings.shipping_charge","packet_bookings.fca_charge","packet_bookings.ex_work_charge","packet_bookings.total_charges","packet_bookings.cpickup as pickup","packet_bookings.cdrop as drop","packet_bookings.payment_gateway","packet_bookings.payment_status","packet_bookings.payment_type","packet_bookings.payment_response","packet_bookings.invoice_no","packet_bookings.packet_description","packet_bookings.pcs_weight as weight","packet_bookings.chargeable_weight","packet_bookings.operation_remark","packet_bookings.accounting_remark","client_masters.client_name"); 
            }
        }else{
            $packetBook=$packetBook->select("packet_bookings.id","packet_bookings.courier_type","packet_bookings.uuid","packet_bookings.awb_no","packet_bookings.reference_no","packet_bookings.booking_date","packet_bookings.client_id","packet_bookings.csr_consignor","packet_bookings.csr_contact_person_code","packet_bookings.csr_contact_person","packet_bookings.csr_address1","packet_bookings.csr_address2","packet_bookings.csr_address3","packet_bookings.csr_pincode","packet_bookings.csr_country_id","packet_bookings.csr_state_id","packet_bookings.csr_city_id","packet_bookings.csr_mobile_code","packet_bookings.csr_mobile_no","packet_bookings.S_idProof as kyc_document","packet_bookings.csr_email_id","packet_bookings.csr_pan","packet_bookings.csr_gstin as vat","packet_bookings.csr_iec","packet_bookings.csn_consignor","packet_bookings.csn_contact_person_code","packet_bookings.csn_contact_person","packet_bookings.csn_address1","packet_bookings.csn_address2","packet_bookings.csn_address3","packet_bookings.csn_pincode","packet_bookings.csn_country_id","packet_bookings.csn_state_id","packet_bookings.csn_city_id","packet_bookings.csn_tan_number","packet_bookings.R_other as csn_landmark","packet_bookings.S_other as csr_landmark","packet_bookings.S_default as default_address","packet_bookings.S_residential as residential_address","packet_bookings.csn_mobile_code","packet_bookings.csn_mobile_no","packet_bookings.csn_iec_number","packet_bookings.csn_bn_number","packet_bookings.csn_tan_number","packet_bookings.no_of_package","packet_bookings.container_type","packet_bookings.commodity","packet_bookings.commodity_type","packet_bookings.csn_email_id","packet_bookings.packet_type","packet_bookings.shipping_charge","packet_bookings.fca_charge","packet_bookings.ex_work_charge","packet_bookings.total_charges","packet_bookings.cpickup as pickup","packet_bookings.cdrop as drop","packet_bookings.payment_gateway","packet_bookings.payment_status","packet_bookings.payment_type","packet_bookings.payment_response","packet_bookings.invoice_no","packet_bookings.packet_description","packet_bookings.pcs_weight as weight","packet_bookings.chargeable_weight","packet_bookings.operation_remark","packet_bookings.accounting_remark","client_masters.client_name"); 
        } 
        $packetBook=$packetBook->where(function ($sqlAdd) use ($startdate,$enddate){
            if($startdate!=NULL && $enddate!=NULL){
                $sqlAdd->where('booking_date','>=',$startdate)
                ->where('booking_date','<=',$enddate);
            }elseif($startdate!=NULL){
                $sqlAdd->where('booking_date','>=',$startdate);
            }elseif($enddate!=NULL){
                $sqlAdd->where('booking_date','<=',$enddate);
            }
        })
        ->where(function ($sqlAdd) use ($client_id,$vendor_id){
            if($client_id!=0){
                $sqlAdd->where('client_id',$client_id);
            }
        });
        if(!empty($courierType)){
            $packetBook =$packetBook->where(function ($sqlAdd) use ($courierType){
                if($courierType!=0){
                    $sqlAdd->where('courier_type',$courierType);
                }
            });
        }
        $packetBook=$packetBook->where(function ($sqlAdd) use ($consignee,$booking_status,$destination,$consignor,$forwarding_no,$csr_mobile){
            if($consignee!=NULL){
                $sqlAdd->where('csn_consignor','LIKE','%'.$consignee.'%');
            }
            if($consignor!=NULL){
                $sqlAdd->where('csr_consignor','LIKE','%'.$consignor.'%');
            }
            if($csr_mobile!=NULL){
                $sqlAdd->where('csr_mobile_no',$csr_mobile);
            }
        })
        ->where(function ($sqlAdd) use ($awb_no){
            if($awb_no!=NULL){
                $array = explode(',', $awb_no);
                $sqlAdd->whereIn('awb_no',$array);
            }
        })
        ->get();
        $type = 'xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        if(!empty(count($packetBook))){
            $packetBookKeys=array_keys($packetBook->first()->toArray());
            foreach($packetBookKeys as $key=>$packetBookKey){
                $sheet->setCellValue(getAlphabates($key,count($packetBookKeys))."1",ucwords(str_replace("_"," ",$packetBookKey)));
            }
        }
        $rows = 2;
        foreach($packetBook as $row){
            $packetBookInfo=$row->toArray();
            $i=0;
            foreach($packetBookInfo as $key=>$packetBookKey){
                if($key=="payment_response"){
                    $sheet->setCellValue(getAlphabates($i,count($packetBookInfo)).$rows,checkKeyExists("transactionid",jsonToArrayConvert($packetBookKey)));
                }else{
                    $sheet->setCellValue(getAlphabates($i,count($packetBookInfo)).$rows,$packetBookKey);
                }
                $i++;
            }
            $rows++;
        }
        $fileName = $courierType?$courierType:"all"."-packet-booking.".$type;
        if($type == 'xlsx') {
        $writer = new Xlsx($spreadsheet);
        } else if($type == 'xls') {
        $writer = new Xls($spreadsheet);
        }
        $writer->save("export/".$fileName);
        header("Content-Type: application/vnd.ms-excel");
        return redirect(url('/')."/export/".$fileName);
        exit;
    }
    public function searchPacketBooking(Request $request){
        $data = PacketBooking::where('awb_no', $request->awb_no)->first();
        echo json_encode($data);
    }

    public function importPacket(Request $request){
        return view('packet.import_booking');
    }
    public function importPacketSave(Request $request){
        $the_file = $request->file('import_packet');
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'F', $column_limit );
            $startcount = 2;
            $data = array();
            $check = array();


            $clientData = ClientMaster::select('id','client_name')->get();
            $countryData = Country::select('id','country_name')->get();
            $clientArray = [];$countryArray = [];
            foreach($clientData as $rowc){
                $clientArray[strtolower($rowc->client_name)] = $rowc->id;
            }
            foreach($countryData as $rowct){
                $countryArray[strtolower($rowct->country_name)] = $rowct->id;
            }
            foreach ( $row_range as $key=>$row ) {
                
                $client_id = isset($clientArray[strtolower($sheet->getCell( 'D' . $row )->getValue())])?$clientArray[strtolower($sheet->getCell( 'D' . $row )->getValue())]:1;
                $csrCountry = isset($countryArray[strtolower($sheet->getCell( 'K' . $row )->getValue())])?$countryArray[strtolower($sheet->getCell( 'K' . $row )->getValue())]:1;
                $csnCountry = isset($countryArray[strtolower($sheet->getCell( 'Z' . $row )->getValue())])?$countryArray[strtolower($sheet->getCell( 'Z' . $row )->getValue())]:1;
                $data[] = [
                    'awb_no' => $sheet->getCell( 'A' . $row )->getValue(),
                    'reference_no' => $sheet->getCell( 'B' . $row )->getValue(),
                    'booking_date' => $sheet->getCell( 'C' . $row )->getValue(),
                    'client_id' =>$client_id,
                    'csr_consignor' => $sheet->getCell( 'E' . $row )->getValue(),
                    'csr_contact_person' => $sheet->getCell( 'F' . $row )->getValue(),
                    'csr_address1' => $sheet->getCell( 'G' . $row )->getValue(),
                    'csr_address2' => $sheet->getCell( 'H' . $row )->getValue(),
                    'csr_address3' => $sheet->getCell( 'I' . $row )->getValue(),
                    'csr_pincode' => $sheet->getCell( 'J' . $row )->getValue(),
                    'csr_country_id' => $csrCountry,
                    'csr_state_id' => $sheet->getCell( 'L' . $row )->getValue(),
                    'csr_city_id' => $sheet->getCell( 'M' . $row )->getValue(),
                    'csr_mobile_no' => $sheet->getCell( 'N' . $row )->getValue(),
                    'csr_email_id' => $sheet->getCell( 'O' . $row )->getValue(),
                    'csr_pan' => $sheet->getCell( 'P' . $row )->getValue(),
                    'csr_gstin' => $sheet->getCell( 'Q' . $row )->getValue(),
                    'csr_iec' => $sheet->getCell( 'R' . $row )->getValue(),
                    'csr_aadharno' => $sheet->getCell( 'S' . $row )->getValue(),
                    'csn_consignor' => $sheet->getCell( 'T' . $row )->getValue(),
                    'csn_contact_person' => $sheet->getCell( 'U' . $row )->getValue(),
                    'csn_address1' => $sheet->getCell( 'V' . $row )->getValue(),
                    'csn_address2' => $sheet->getCell( 'W' . $row )->getValue(),
                    'csn_address3' => $sheet->getCell( 'X' . $row )->getValue(),
                    'csn_pincode' => $sheet->getCell( 'Y' . $row )->getValue(),
                    'csn_country_id' => $csnCountry,
                    'csn_state_id' => $sheet->getCell( 'AA' . $row )->getValue(),
                    'csn_city_id' => $sheet->getCell( 'AB' . $row )->getValue(),
                    'csn_mobile_no' => $sheet->getCell( 'AC' . $row )->getValue(),
                    'csn_email_id' => $sheet->getCell( 'AD' . $row )->getValue(),
                    'shipping_charge' => $sheet->getCell( 'AE' . $row )->getValue(),
                    'length' => $sheet->getCell( 'AF' . $row )->getValue(),
                    'width' => $sheet->getCell( 'AG' . $row )->getValue(),
                    'height' => $sheet->getCell( 'AH' . $row )->getValue(),
                    'packet_type' => $sheet->getCell( 'AI' . $row )->getValue(),
                    'payment_type' => $sheet->getCell( 'AJ' . $row )->getValue(),
                    'invoice_no' => $sheet->getCell( 'AK' . $row )->getValue(),
                    'packet_description' => $sheet->getCell( 'AL' . $row )->getValue(),
                    'pcs_weight' => $sheet->getCell( 'AM' . $row )->getValue(),
                    'actual_weight' => $sheet->getCell( 'AN' . $row )->getValue(),
                    'vendor_weight' => $sheet->getCell( 'AO' . $row )->getValue(),
                    'vendor_weight_type' => $sheet->getCell( 'AP' . $row )->getValue(),
                    'total_weight' => $sheet->getCell( 'AQ' . $row )->getValue(),
                    'currency' => $sheet->getCell( 'AR' . $row )->getValue(),
                    'devisor' => $sheet->getCell( 'AS' . $row )->getValue(),
                    'operation_remark' => $sheet->getCell( 'AT' . $row )->getValue(),
                    'accounting_remark' => $sheet->getCell( 'AU' . $row )->getValue(),
                    'created_by' => auth()->user()->id,
                    'dvalue'=>0
                ];
                $check=['awb_no'];
                $startcount++;
            }
            PacketBooking::upsert($data,$check);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return back()->withSuccess('Great! Data has been successfully uploaded.');
    }

    public function bookingReport(Request $request){
        // dd($request);
        $client = ClientMaster::select('client_name','id')->get();

        $vendor = VendorMaster::select('name','id')->get();
        $var = '';
        $client_id = isset($request->client_id) ? $request->client_id : 0;
        $vendor_id= isset($request->vendor) ? $request->vendor : 0;
        $consignee = isset($request->consignee) ? $request->consignee : NULL;
        $startdate =isset($request->startdate) ? date("Y-m-d",strtotime($request->startdate)) : NULL;
        $enddate =isset($request->enddate) ? date("Y-m-d",strtotime($request->enddate)) : NULL;
        $awb_no = isset($request->awb_no) ? $request->awb_no : NULL;
        $booking_status = isset($request->booking_status) ? $request->booking_status : NULL;
        $destination = isset($request->destination) ? $request->destination : NULL;
        $consignor = isset($request->consignor) ? $request->consignor : NULL;
        $forwarding_no = isset($request->forwarding_no) ? $request->forwarding_no : NULL;
        $csr_mobile= isset($request->csr_mobile) ? $request->csr_mobile : NULL;
        
        $packetBook = PacketBooking::leftjoin('client_masters','client_masters.id','=','packet_bookings.client_id')
        ->select('packet_bookings.*','client_masters.client_name')
        ->where(function ($sqlAdd) use ($startdate,$enddate){
            if($startdate!=NULL && $enddate!=NULL){
                $sqlAdd->where('booking_date','>=',$startdate)->where('booking_date','<=',$enddate);
            }elseif($startdate!=NULL){
                $sqlAdd->where('booking_date','>=',$startdate);
            }elseif($enddate!=NULL){
                $sqlAdd->where('booking_date','<=',$enddate);
            }
        })
        ->where(function ($sqlAdd) use ($client_id,$vendor_id){
            if($vendor_id!=0){
                // $sqlAdd->where('client_id',$client_id);
            }
            if($client_id!=0){
                $sqlAdd->where('client_id',$client_id);
            }
        })
        ->where(function ($sqlAdd) use ($consignee,$booking_status,$destination,$consignor,$forwarding_no,$csr_mobile){
            if($consignee!=NULL){
                $sqlAdd->where('csn_consignor','LIKE','%'.$consignee.'%');
            }
            if($consignor!=NULL){
                $sqlAdd->where('csr_consignor','LIKE','%'.$consignor.'%');
            }
            if($booking_status!=NULL){
                // $sqlAdd->where('csn_consignor','LIKE','%'.$booking_status.'%');
            }
            if($destination!=NULL){
                // $sqlAdd->where('csn_consignor','LIKE','%'.$booking_status.'%');
            }
            if($forwarding_no!=NULL){
                // $sqlAdd->where('csn_consignor','LIKE','%'.$booking_status.'%');
            }
            if($csr_mobile!=NULL){
                $sqlAdd->where('csr_mobile_no',$csr_mobile);
            }

        })
        ->where(function ($sqlAdd) use ($awb_no){
            if($awb_no!=NULL){
                $array = explode(',', $awb_no);
                $sqlAdd->whereIn('awb_no',$array);
            }
        })
        // ->get();
        ->paginate(env('page_default_val'));
        return view('packet.booking_report',compact('client','vendor','packetBook'));
    }

    public function manifestReport(Request $request){
        return view('packet.manifest_report');
    }

    public function deliveredReport(Request $request){
        
        return view('packet.delivered_report');
    }
    public function shipmentRate()
    {
        $country = ShippingZone::all();
        return view('packet.shipment_rate', compact('country'));
    }
    public function shipmentGetRate(Request $request)
    {
        $res = [];
        $count = ShippingZone::find($request->destination);

        // $FEDEXzone = ZoneRate::where('carrier_type', 'FEDEX')->where('weight', '>=', $request->weight)->first();
        $DHLzone = ZoneRate::where('package_type', $request->package_type)->where('carrier_type', 'DHL')->where('weight', '>=', $request->weight)->first();
        $DPDzone = ZoneRate::where('package_type', 'NONE')->where('carrier_type', 'DPD')->where('weight', '>=', $request->weight)->first();
        // dd($DHLzone, $DPDzone);
        // $UPSzone = ZoneRate::where('carrier_type', 'UPS')->where('weight', '>=', $request->weight)->first();
        // $AMXzone = ZoneRate::where('carrier_type', 'ARAMAX')->where('weight', '>=', $request->weight)->first();
        // dd($FEDEXzone->rate);
        // $FEDEXdata = json_decode($FEDEXzone->rate, true);
        if (empty($DHLzone)) {
            $max_W = ZoneRate::where('package_type', $request->package_type)->where('carrier_type', 'DHL')->max('weight');
            $res['warning'] = 'maximum weight ' . $max_W . ' allowed for DHL ' . $request->package_type;
        }
        if (isset($DHLzone->rate)) {
            $DHLdata = json_decode($DHLzone->rate, true);
        }
        if (isset($DPDzone->rate)) {
            $DPDdata = json_decode($DPDzone->rate, true);
        }
        // $UPSdata = json_decode($UPSzone->rate, true);
        // $AMXdata = json_decode($AMXzone->rate, true);
        // dd($FEDEXdata);

        $res['origin'] = 'Germany';
        $res['destination'] = $count->country;
        $res['weight'] = $request->weight;
        // $res['Fedex']['rate'] = $FEDEXdata['ZONE_' . $count->fedex_zone];
        // $res['Fedex']['zone'] = $count->fedex_zone;
        if (isset($DHLdata['ZONE_' . $count->dhl_zone])) {
            $res['DHL']['rate'] = $DHLdata['ZONE_' . $count->dhl_zone];
            $res['DHL']['zone'] = $count->dhl_zone;
        } else {
            $res['DHL']['rate'] = 'NIL';
            $res['DHL']['zone'] = 'NIL';
        }

        if (isset($DPDdata['ZONE_' . $count->dpd_zone])) {
            $res['DPD']['rate'] = $DPDdata['ZONE_' . $count->dpd_zone];
            $res['DPD']['zone'] = $count->dpd_zone;
        } else {
            $res['DPD']['rate'] = 'NIL';
            $res['DPD']['zone'] = 'NIL';
        }

        // $res['UPS']['rate'] = $UPSdata['ZONE_' . $count->ups_zone];
        // $res['UPS']['zone'] = $count->ups_zone;

        // $res['AMX']['rate'] = $AMXdata['ZONE_' . $count->aramex_zone];
        // $res['AMX']['zone'] = $count->aramex_zone;
        asort($res);
        array_reverse($res);
        // dd($res);
        return redirect()->back()->with('data', $res);
    }
    public function updateShippingRates(Request $request){
        /*$this->validate($request,[
            'pcs_weight' => 'required',
            'chargeable_weight' => 'required',
            'shipping_charge' => 'required'
        ]);*/
        $shipping_charge=isset($request->shipping_charge) ? $request->shipping_charge :0;
        $fca_charge=isset($request->fca_charge) ? $request->fca_charge :0;
        $ex_work_charge=isset($request->ex_work_charge) ? $request->ex_work_charge :0;
        $total_charges=($shipping_charge+$fca_charge+$ex_work_charge);
        $data = [
            'pcs_weight' => isset($request->pcs_weight) ? $request->pcs_weight : "",
            'chargeable_weight' => isset($request->chargeable_weight) ? $request->chargeable_weight : "",
            'shipping_charge' => isset($request->shipping_charge) ? $request->shipping_charge :0,
            'fca_charge' => isset($request->fca_charge) ? $request->fca_charge :0,
            'ex_work_charge' => isset($request->ex_work_charge) ? $request->ex_work_charge :0,
            'total_charges' =>$total_charges,
        ];
        if(!empty($request->id)){
            $result = PacketBooking::where('id',$request->id)->update($data);
            $msg = "Packet Booking Update Successfully";
        }            
        if($result){
            return redirect()->back()->with('success',$msg);
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }
    
    public function sendShipmentQuotationEmailToCustomer($id){
        if(!empty($id)){
            $packetInfo = PacketBooking::where('id',$id)->get()->first();
            if(!empty($packetInfo)){
                $packetInfo=$packetInfo->toArray();
                if(checkKeyExists("shipping_charge",$packetInfo)){
                    //mydd($packetInfo);            
                    /**Send Email To Customer */
                    if(!empty($packetInfo)){
                        $orderData['name']=$packetInfo['csr_consignor_person']?$packetInfo['csr_consignor_person']:$packetInfo['csr_consignor'];
                        $orderData['origin']=$packetInfo['csr_country_id']?getCountries($packetInfo['csr_country_id']):"";
                        $orderData['destination']=$packetInfo['csn_country_id']?getCountries($packetInfo['csn_country_id']):"";
                        $orderData['booking_date']=$packetInfo['booking_date']?date("Y-m-d",strtotime($packetInfo['booking_date'])):"";
                        $orderData['email']=$packetInfo['csr_email_id'];
                        $orderData['shipping_charge']=$packetInfo['shipping_charge']?$packetInfo['shipping_charge']:0;
                        $orderData['fca_charge']=$packetInfo['fca_charge']?$packetInfo['fca_charge']:0;
                        $orderData['ex_work_charge']=$packetInfo['ex_work_charge']?$packetInfo['ex_work_charge']:0;
                        $totalCharges=($orderData['shipping_charge']+$orderData['fca_charge']+$orderData['ex_work_charge']);
                        $orderData['total_charges']=$packetInfo['total_charges']?$packetInfo['total_charges']:$totalCharges;
                        if(!empty($packetInfo['courier_type']) && ($packetInfo['courier_type']=="courier")){
                            $orderData['subject']="Courier freight shipment quotation";
                            $orderData['email_template']="emails.shipments.courier_quotation_to_customer";
                            $orderData['chargeable_weight']=$packetInfo['chargeable_weight']?$packetInfo['chargeable_weight']:"";
                        }elseif(!empty($packetInfo['courier_type']) && ($packetInfo['courier_type']=="air")){
                            $orderData['subject']="Air Freight Shipment Quotation";
                            $orderData['email_template']="emails.shipments.air_freight_quotation_to_customer";
                            $orderData['chargeable_weight']=$packetInfo['chargeable_weight']?$packetInfo['chargeable_weight']:"";
                        }elseif(!empty($packetInfo['courier_type']) && ($packetInfo['courier_type']=="ocean")){
                            $orderData['subject']="Ocean Freight Shipment Quotation";
                            $orderData['email_template']="emails.shipments.ocean_freight_quotation_to_customer";
                            $orderData['container_type']=$packetInfo['container_type']?$packetInfo['container_type']:"";
                        }
                        $emailContent=array(
                            "subject"=>$orderData['subject'],
                            "email_template"=>$orderData['email_template'],
                            "email_content"=>($orderData)
                        );
                        $emailStatus=sendMyEmail($orderData['email'],$emailContent);
                        if(!empty($emailStatus)){
                            $packetObj=PacketBooking::find($packetInfo['id']);
                            $packetObj->booking_status=1;
                            $packetObj->quatation_email_date=date("Y-m-d H:i:s");
                            $packetObj->save();
                            $message="Quotation email send successfully to customer";
                        }else{
                            $message="Quotation email not send to customer, please try again";
                        }
                        return redirect(route('packet.view',$id))->with('success',$message);
                    }
                    return redirect(route('packet.view',$id))->with('success',$message);
                }
            }
            return redirect(route('packet.view',$id))->back()->with('error','Something went wrong please try again!');
        }
        return redirect(route('packet.listing'))->with('error','Something went wrong please try again!');
    }

    public function sendShipmentPaymentEmailToCustomer($id){
        if(!empty($id)){
            $packetInfo = PacketBooking::where('id',$id)->get()->first();
            if(!empty($packetInfo)){
                $packetInfo=$packetInfo->toArray();
                if(checkKeyExists("shipping_charge",$packetInfo)){
                    //mydd($packetInfo);            
                    /**Send Email To Customer */
                    if(!empty($packetInfo)){
                        $orderData['name']=$packetInfo['csr_consignor_person']?$packetInfo['csr_consignor_person']:$packetInfo['csr_consignor'];
                        $orderData['origin']=$packetInfo['csr_country_id']?getCountries($packetInfo['csr_country_id']):"";
                        $orderData['destination']=$packetInfo['csn_country_id']?getCountries($packetInfo['csn_country_id']):"";
                        $orderData['shipper_name']=$orderData['name'];
                        $orderData['receiver_name']=$packetInfo['csn_consignor_person']?$packetInfo['csn_consignor_person']:$packetInfo['csn_consignor'];
                        $orderData['shipment_mode']=$packetInfo['courier_type']?ucwords($packetInfo['courier_type']):"";
                        $orderData['booking_date']=$packetInfo['booking_date']?date("Y-m-d",strtotime($packetInfo['booking_date'])):"";
                        $orderData['email']=$packetInfo['csr_email_id'];
                        $orderData['shipping_charge']=$packetInfo['shipping_charge']?$packetInfo['shipping_charge']:0;
                        $orderData['fca_charge']=$packetInfo['fca_charge']?$packetInfo['fca_charge']:0;
                        $orderData['ex_work_charge']=$packetInfo['ex_work_charge']?$packetInfo['ex_work_charge']:0;
                        $totalCharges=($orderData['shipping_charge']+$orderData['fca_charge']+$orderData['ex_work_charge']);
                        $orderData['total_charges']=$packetInfo['total_charges']?$packetInfo['total_charges']:$totalCharges;
                        $orderData['chargeable_weight']=$packetInfo['chargeable_weight']?$packetInfo['chargeable_weight']:"";
                        $orderData['payment_link']=route("user.create.shipment.payment",encryptToBase64($packetInfo['id']));                        
                        $orderData['subject']="Your booking is now confirmed";
                        $orderData['email_template']="emails.shipments.payment_link_to_customer";
                        $emailContent=array(
                            "subject"=>$orderData['subject'],
                            "email_template"=>$orderData['email_template'],
                            "email_content"=>($orderData)
                        );
                        sendMyEmail($orderData['email'],$emailContent);
                    }
                    $message="Paymnet link email send successfully to customer";
                    return redirect(route('packet.view',$id))->with('success',$message);
                }
            }
            return redirect(route('packet.view',$id))->back()->with('error','Something went wrong please try again!');
        }
        return redirect(route('packet.listing'))->with('error','Something went wrong please try again!');
    }
}
