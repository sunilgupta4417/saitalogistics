<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\PacketBooking;
use App\Models\Shipment;
use App\Models\Reason;
use Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PDF;
class OtherApiController extends Controller
{
   
    public function printAWBDocument(Request $request){
        return view('other.print_awb_document');
    }
    public function printAwbDocPdf(Request $request){
        $awb_no = 'awb001';
        $invoiceData = PacketBooking::join('country','country.id','=','csr_country_id')
        ->join('country as c','c.id','=','csn_country_id')
        ->select('packet_bookings.*','country.country_name','c.country_name as csn_country_name')->where('awb_no',$awb_no)->first();
        return view('pdf.awb_invoice_print',compact('invoiceData'));
        exit;
        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com',
        //     'date' => date('m/d/Y')
        // ];
          
        // $pdf = PDF::loadView('pdf.awb_label_print', $data);
    
        // return $pdf->download('packet_booking_label_print.pdf');
        // // echo public_path();
        // // exit;
        // $data = Reason::all();
        // // share data to view
        // view()->share('other.print_awb_document',$data);
        // $pdf = PDF::loadView('pdf_view', $data);
        // // download PDF file with download method
        // return $pdf->download('pdf_file.pdf');
        // // return view('other.print_awb_document');
    }
    public function printAwblabelPdf(Request $request){
        $awb_no = 'awb001';
        $labelData = PacketBooking::join('country','country.id','=','csr_country_id')
        ->join('country as c','c.id','=','csn_country_id')
        ->join('client_masters','client_masters.id','=','packet_bookings.client_id')
        ->select('packet_bookings.*','country.country_name','c.country_name as csn_country_name','client_masters.client_name')->where('awb_no',$awb_no)->first();
        return view('pdf.awb_label_print',compact('labelData'));
        
    }
    public function shipmentMovement(Request $request){
        $packetbooking = PacketBooking::select('id','awb_no')->get();
        $shipment = Shipment::join('packet_bookings','packet_bookings.id','=','shipments.awb_id')
        ->join('client_masters','client_masters.id','=','packet_bookings.client_id')
        ->select('shipments.*','packet_bookings.awb_no','packet_bookings.csn_consignor',
        'packet_bookings.csr_mobile_no','packet_bookings.csr_consignor',
        'client_masters.client_name')
        ->paginate(env('page_default_val'));
        $id = $request->query('id',0);
        $shipmentEdit = NULL;
        if($id!=0){
            $shipmentEdit = Shipment::select('*')->where('id',$id)->first();
        }
        return view('other.shipment_movement',compact('packetbooking','shipment','shipmentEdit'));
    }
    public function shipmentSave(Request $request){
        $this->validate($request,[
            'awb_id'=>'required',
            'shipment_date'=>'required',
            'shipment_time'=>'required',
            'status'=>'required',
            'location'=>'required',
            'status_details'=>'required',
         ]);
       $user = Auth::user(); 
        if($request->shipment_id!=0){
            $shipment = Shipment::find($request->shipment_id);
            $msg = 'Shipment updated successfully!';
        }else{
            $shipment = new Shipment;
            $shipment->created_by = $user->id;
            $msg = 'Shipment added successfully!';
        }
       $shipment->awb_id = isset($request->awb_id) ? $request->awb_id : 0;
       $shipment->shipment_date = isset($request->shipment_date) ? date("Y-m-d H:i:s",strtotime($request->shipment_date)) : NULL;
       $shipment->shipment_time = isset($request->shipment_time) ? $request->shipment_time : NULL;
       $shipment->status = isset($request->status) ? $request->status : NULL;
       $shipment->location = isset($request->location) ? $request->location : NULL;
       $shipment->status_details = isset($request->status_details) ? $request->status_details : NULL;
       
        $result = $shipment->save();
        if($result){
            return redirect()->back()->with('success',$msg);
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }
    public function shipmentDelete($id){
        $result = Shipment::where('id',$id)->delete();
        if($result){
            return redirect()->back()->with('success','Shipment deleted successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        } 
    }
    public function podUpload(Request $request){
        return view('other.pod_upload');
    }

    public function countryMaster(Request $request){

      
        


        $country = Country::select('*');
        $totalCoutry = $country->count();
        $country = $country->paginate(env('page_default_val'));
        return view('other.country_master',compact('country','totalCoutry'));
    }
    public function countrySave(Request $request){
        $this->validate($request,[
            'country_name'=>'required',
            'country_code'=>'required|min:2|max:3',
         ]);

        $checkCountry = Country::where('country_name',$request->country_name)
        ->where('country_code',$request->country_code)->first();
        if($checkCountry){
            return redirect()->back()->with('error','This name is already exist!');
        }
        $insData = [
            'country_name'=>isset($request->country_name) ? $request->country_name : NULL, 
            'country_code'=>isset($request->country_code) ? $request->country_code : NULL,
            'isActive'=>1,
        ];
        $result = Country::create($insData);
        if($result){
            return redirect()->back()->with('success','country added successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }
    public function countryUpdate(Request $request){
        $this->validate($request,[
            'country_name'=>'required',
            'country_code'=>'required|min:2|max:3',
         ]);
        $updateData = [
            'country_name'=>isset($request->country_name) ? $request->country_name : NULL, 
            'country_code'=>isset($request->country_code) ? $request->country_code : NULL,
        ];
        $result = Country::where('id',$request->id)->update($updateData);
        if($result){
            return redirect()->back()->with('success','Record updated successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }  
    }
    public function getCountryList(Type $var = null)
    {
        if ($request->ajax()) {
            $columns = array(
               0 => 'country_code',
               
           );
           $data = Country::select('*')
               ->orderBy($columns[$request->order[0]['column']], $request->order[0]['dir']);
          
           // print_r($data);exit;
           return Datatables::of($data)
               ->addIndexColumn()
               ->addColumn('name', function($row){
                  return $row->Country_code;
               })
               ->addColumn('email', function($row){
                  return 0;
               })
               ->addColumn('action', function($row){
                   $btn = '';
                   return $btn;
               })
               ->rawColumns(['name','action'])
               ->make(true);
       }
    }
    public function countryDelete($id){
        $result = Country::where('id',$id)->delete();
        if($result){
            return redirect()->back()->with('success','Record deleted successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }
    public function reasonMaster(Request $request){
        $reason = Reason::join('users','users.id','=','reason.created_by')
        ->select('reason.*','users.name');
        $total = $reason->count();
        $reason = $reason->paginate(env('page_default_val'));
        
        $data = ['reason'=>$reason,'total'=>$total];
        return view('other.reason_master',$data);
    }
    public function reasonSave(Request $request){
        $this->validate($request,[
            'reason_code'=>'required',
            'reason_text'=>'required',
         ]);
        $user = Auth::user();
        $insData=[
            'reason_code'=>isset($request->reason_code) ? $request->reason_code : NULL,
            'reason_text'=>isset($request->reason_text) ? $request->reason_text : NULL,
            'isActive'=>isset($request->isActive) ? $request->isActive : 0,
            'created_by'=>$user->id,
        ];
        $result = Reason::create($insData);
        if($result){
            return redirect()->back()->with('success','Record added successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }
    public function reasonUpdate(Request $request){
        $this->validate($request,[
            'reason_code'=>'required',
            'reason_text'=>'required',
         ]);
        $id = $request->id;
        $updateData=[
            'reason_code'=>isset($request->reason_code) ? $request->reason_code : NULL,
            'reason_text'=>isset($request->reason_text) ? $request->reason_text : NULL,
            'isActive'=>isset($request->isActive) ? $request->isActive : 0,
        ];
        $result = Reason::where('id',$id)->update($updateData);
        if($result){
            return redirect()->back()->with('success','Record updated successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }
    public function reasonDelete($id){
        $result = Reason::where('id',$id)->delete();
        if($result){
            return redirect()->back()->with('success','Record deleted successfully!');
        }else{
           return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }
    public function createInvoice(Request $request){
        return view('other.create_invoice');
    }

    public function invoice(Request $request){
        return view('other.invoice');
    }

    public function vendorApiConfiguration(Request $request){
        return view('other.vendor_api_config');
    }

    ##################EXPORT########################
    public function exportCountry(){
        $countrys = Country::select('*')->get();
        $type = 'xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Country Code');
        $sheet->setCellValue('C1', 'Country Name');
       
        $rows = 2;
        $i=1;
        foreach($countrys as $country){
        $sheet->setCellValue('A' . $rows, $i++);
        $sheet->setCellValue('B' . $rows, $country['country_code']);
        $sheet->setCellValue('C' . $rows, $country['country_name']);
        $rows++;
        }
        $fileName = "country-master.".$type;
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
    
    public function exportReason(){
        $reason = Reason::join('users','users.id','=','reason.created_by')
        ->select('reason.*','users.name')->get();
        $type = 'xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Reason Code');
        $sheet->setCellValue('C1', 'Reason');
        $sheet->setCellValue('D1', 'Active');
        $sheet->setCellValue('E1', 'Created By');
        $sheet->setCellValue('F1', 'Created Date');
       
        $rows = 2;
        $i=1;
        foreach($reason as $row){
        $sheet->setCellValue('A' . $rows, $i++);
        $sheet->setCellValue('B' . $rows, $row['reason_code']);
        $sheet->setCellValue('C' . $rows, $row['reason_text']);
        $sheet->setCellValue('D' . $rows, ($row['isActive']==1?'Yes':'No'));
        $sheet->setCellValue('E' . $rows, $row['name']);
        $sheet->setCellValue('F' . $rows, $row['created_at']);
        $rows++;
        }
        $fileName = "reason-master.".$type;
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
}
