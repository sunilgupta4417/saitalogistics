<?php

namespace App\Http\Controllers;

use App\Models\PacketBooking;
use App\Models\ClientMaster;
use App\Models\vendorMaster;
use App\Models\Country;
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
            // 'divisor' => 'required',
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
               
                $client_id = $clientArray[strtolower($sheet->getCell( 'D' . $row )->getValue())];
                $csrCountry = $countryArray[strtolower($sheet->getCell( 'K' . $row )->getValue())];
                $csnCountry = $countryArray[strtolower($sheet->getCell( 'Z' . $row )->getValue())];
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
                    'csn_pan' => $sheet->getCell( 'AE' . $row )->getValue(),
                    'csn_gstin' => $sheet->getCell( 'AF' . $row )->getValue(),
                    'csn_iec' => $sheet->getCell( 'AG' . $row )->getValue(),
                    'csn_aadharno' => $sheet->getCell( 'AH' . $row )->getValue(),
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

        $vendor = vendorMaster::select('name','id')->get();
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
                $sqlAdd->where('booking_date','>=',strtorime($startdate))
                ->where->where('booking_date','<=',$enddate);
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
        
        ->get();
        return view('packet.booking_report',compact('client','vendor','packetBook'));
    }

    public function manifestReport(Request $request){
        return view('packet.manifest_report');
    }

    public function deliveredReport(Request $request){
        
        return view('packet.delivered_report');
    }
    
}
