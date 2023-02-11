<?php

namespace App\Http\Controllers;

use App\Models\PacketBooking;
use App\Models\ClientMaster;
use App\Models\Country;
use Illuminate\Http\Request;

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
            'client_id'=>'required',
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
            'invoice_no' => 'required',
            'packet_detail' => 'required',
            'pcs' => 'required',
            'actual_weight' => 'required',
            'vendor_weight' => 'required',
            'vendor_packet_type' => 'required',
            'total_value' => 'required',
            'ddlCurrencyType' => 'required',
            'divisor' => 'required',
            'accounting_remark' => 'required',
            'accounting_remark' => 'required',
         ]);
        $data = [
            'awb_no' => isset($request->awb_no) ? $request->awb_no : null,
            'reference_no' => isset($request->ref_no) ? $request->ref_no : null,
            'booking_date' => isset($request->booking_date) ? $request->booking_date : null,
            'client_id' => isset($request->client_id) ? $request->client_id : null,
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
            'csn_pan' => isset($request->consignee_pan) ? $request->consignee_pan : null,
            'csn_gstin' => isset($request->consignee_gstin) ? $request->consignee_gstin : null,
            'csn_iec' => isset($request->consignee_iec) ? $request->consignee_iec : null,
            'csn_aadharno' => isset($request->consignee_aadhar_no) ? $request->consignee_aadhar_no : null,
            'packet_type' => isset($request->packet_type) ? $request->packet_type : null,
            'payment_type' => isset($request->payment_type) ? $request->payment_type : null,
            'invoice_no' => isset($request->invoice_no) ? $request->invoice_no : null,
            'packet_description' => isset($request->packet_detail) ? $request->packet_detail : null,
            'pcs_weight' => isset($request->pcs) ? $request->pcs : null,
            'actual_weight' => isset($request->actual_weight) ? $request->actual_weight : null,
            'vendor_weight' => isset($request->vendor_weight) ? $request->vendor_weight : null,
            'vendor_weight_type' => isset($request->vendor_packet_type) ? $request->vendor_packet_type : null,
            'total_weight' => isset($request->total_value) ? $request->total_value : null,
            'currency' => isset($request->ddlCurrencyType) ? $request->ddlCurrencyType : null,
            'devisor' => isset($request->divisor) ? $request->divisor : null,
            'operation_remark' => isset($request->operation_remark) ? $request->operation_remark : null,
            'accounting_remark' => isset($request->accounting_remark) ? $request->accounting_remark : null,
            'created_by' => auth()->user()->id,
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

    public function searchPacketBooking(Request $request){
        $data = PacketBooking::where('awb_no', $request->awb_no)->first();
        echo json_encode($data);
    }

    public function importPacket(Request $request){
        return view('packet.import_booking');
    }

    public function bookingReport(Request $request){
        return view('packet.booking_report');
    }

    public function manifestReport(Request $request){
        return view('packet.manifest_report');
    }

    public function deliveredReport(Request $request){
        return view('packet.delivered_report');
    }
    
}
