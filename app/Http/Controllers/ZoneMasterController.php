<?php

namespace App\Http\Controllers;

use App\Models\ZoneMaster;
use App\Models\VendorMaster;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class ZoneMasterController extends Controller
{
    public function zoneMaster(Request $request){

        $vendorMaster = VendorMaster::select('id','name')->get();
        $editId = $request->query('id', 0);
        $editZone = NULL;
        if($editId!=0){
            $editZone = ZoneMaster::find($request->id);
        }
        $zoneMaster = ZoneMaster::select('zone_masters.*','vendor_masters.name')->join('vendor_masters','zone_masters.vendor_id','=','vendor_masters.id')
        ->whereNull('zone_masters.deleted_at');
        $total = $zoneMaster->count();
       $zoneMaster =  $zoneMaster->paginate(env('page_default_val'));
        
        return view('zone.index',compact('vendorMaster','editZone','zoneMaster','total'));
    }
    public function zoneMasterSave(Request $request){
        $this->validate($request,[
            'vendor_id'=>'required',
            'service_name'=>'required',
            'zone_name'=>'required',
            'zone_type'=>'required',
            'effctv_from'=>'required',
         ]);
        if($request->id!=0){
            $msg = 'Zone master updated successfully!';
            $zoneMaster = ZoneMaster::find($request->id);
        }else{
            $msg = 'Zone master added successfully!';
            $zoneMaster = new ZoneMaster;    
        }
        $zoneMaster->vendor_id =    isset($request->vendor_id) ? $request->vendor_id : 0;
        $zoneMaster->service_name = isset($request->service_name) ? $request->service_name : NULL;
        $zoneMaster->zone_name =    isset($request->zone_name) ? $request->zone_name : NULL;
        $zoneMaster->zone_type =    isset($request->zone_type) ? $request->zone_type : NULL;
        $zoneMaster->effctv_from =    isset($request->effctv_from) ? $request->effctv_from : NULL;
        $result = $zoneMaster->save();
        if($result){
            return redirect()->back()->with('success',$msg);
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }
    public function zoneMasterDelete($id){
        $result = ZoneMaster::where('id',$id)->update(['deleted_at'=>NOW()]);
        if($result){
            return redirect()->back()->with('success','Record deleted successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }

    public function exportZone(){
        
        $zoneMaster = ZoneMaster::select('zone_masters.*','vendor_masters.name')->join('vendor_masters','zone_masters.vendor_id','=','vendor_masters.id')
        ->whereNull('zone_masters.deleted_at')->get();
        $type = 'xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Vendor');
        $sheet->setCellValue('C1', 'Service');
        $sheet->setCellValue('D1', 'Zone Name');
        $sheet->setCellValue('E1', 'Zone Type');
        $sheet->setCellValue('F1', 'Effect From');
       
        $rows = 2;
        $i=1;
        foreach($zoneMaster as $row){
        $sheet->setCellValue('A' . $rows, $i++);
        $sheet->setCellValue('B' . $rows, $row['name']);
        $sheet->setCellValue('C' . $rows, $row['service_name']);
        $sheet->setCellValue('D' . $rows, $row['zone_name']);
        $sheet->setCellValue('E' . $rows, ($row['zone_type']=='Domestic' ?'Domestic' :'International' ));
        $sheet->setCellValue('F' . $rows, $row['effctv_from']);
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
