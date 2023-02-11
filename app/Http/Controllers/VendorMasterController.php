<?php

namespace App\Http\Controllers;

use App\Models\VendorMaster;
use App\Models\VendorAccountDetail; 
use App\Models\VendorServiceType;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class VendorMasterController extends Controller
{

    public function vendorMaster()
    {
        $country = Country::where('isActive',1)->get();
        $vendor = vendorMaster::select('vendor_masters.*','country.country_name')
        ->leftjoin('country','country.id','=','vendor_masters.country_id');
        $totalVendor = $vendor->count();
        $vendor = $vendor->paginate(env('page_default_val'));
        return view('vendor_module.vendor_master',compact('country','vendor','totalVendor'));
    }

    public function vendormasterSave(Request $request){
        $this->validate($request,[
           'vendor_code'=>'required',
           'email'=>'required|email',
           'name'=>'required',
           'mobile_no'=>'required',
           'address1'=>'required',
           'address2'=>'required',
           'city_id'=>'required',
           'state_id'=>'required',
           'country_id'=>'required',
           'pincode'=>'required',
           'gstin'=>'required',
        ]);

        $insData = [
            'vendor_code'=>isset($request->vendor_code) ? $request->vendor_code : NULL,
            'email'=>isset($request->email) ? $request->email : NULL,
            'name'=>isset($request->name) ? $request->name : NULL,
            'mobile_no'=>isset($request->mobile_no) ? $request->mobile_no : NULL,
            'address1'=>isset($request->address1) ? $request->address1 : NULL,
            'address2'=>isset($request->address2) ? $request->address2 : NULL,
            'pincode'=>isset($request->pincode) ? $request->pincode : NULL,
            'city_id'=>isset($request->city_id) ? $request->city_id : NULL,
            'state_id'=>isset($request->state_id) ? $request->state_id : NULL,
            'country_id'=>isset($request->country_id) ? $request->country_id : NULL,
            'gstin'=>isset($request->gstin) ? $request->gstin : NULL,
            'isActive'=>isset($request->isActive) ? $request->isActive : 0,
            'selfVendor'=>isset($request->selfVendor) ? $request->selfVendor : 0, 
            'third_party_tracking'=>isset($request->third_party_tracking) ? $request->third_party_tracking : 0, 
        ];

        if($request->vendor_id == 0){
            $result= vendorMaster::create($insData);

            if(isset($request->vendor) && count($request->vendor) > 0){
                foreach($request->vendor as $vendorItem){
                    if(isset($vendorItem['service']) && !empty($vendorItem['service'])){
                        $saveVendor[] = [
                            'vendor_id' => $result->id,
                            'forwarder' => isset($vendorItem['forwarder']) ? $vendorItem['forwarder']: NULL,
                            'service_name' => isset($vendorItem['service']) ? $vendorItem['service']: NULL,
                            'packagin_group' => isset($vendorItem['packaging']) ? $vendorItem['packaging']: NULL,
                            'mode' => isset($vendorItem['mode']) ? $vendorItem['mode']: NULL,
                            'isActive' => isset($vendorItem['status']) ? $vendorItem['status']: 0,
                            'created_at' => date('Y-m-d h:s:i'),
                            'updated_at' => date('Y-m-d h:s:i'),
                        ];
                    }   
                }
                if(count($saveVendor) > 0){
                    VendorServiceType::insert($saveVendor);
                }
            }    
        }else{
            $result= vendorMaster::where('id',$request->vendor_id)->update($insData);

            VendorServiceType::where('vendor_id',$request->vendor_id)->delete();

            if(isset($request->vendor) && count($request->vendor) > 0){
                $saveVendor = [];
                foreach($request->vendor as $vendorItem){
                    if(isset($vendorItem['id']) && $vendorItem['id'] > 0){
                        if(isset($vendorItem['service']) && !empty($vendorItem['service'])){
                            $updateVendor = [
                                // 'vendor_id' => $request->vendor_id,
                                'forwarder' => isset($vendorItem['forwarder']) ? $vendorItem['forwarder']: NULL,
                                'service_name' => isset($vendorItem['service']) ? $vendorItem['service']: NULL,
                                'packagin_group' => isset($vendorItem['packaging']) ? $vendorItem['packaging']: NULL,
                                'mode' => isset($vendorItem['mode']) ? $vendorItem['mode']: NULL,
                                'isActive' => isset($vendorItem['status']) ? $vendorItem['status']: 0,
                                'updated_at' => date('Y-m-d h:s:i'),
                            ];
                            VendorServiceType::where('id',$vendorItem['id'])->restore();
                            VendorServiceType::where('id',$vendorItem['id'])->update($updateVendor);
                        }
                    }else{
                        if(isset($vendorItem['service']) && !empty($vendorItem['service'])){
                            $saveVendor[] = [
                                'vendor_id' => $request->vendor_id,
                                'forwarder' => isset($vendorItem['forwarder']) ? $vendorItem['forwarder']: NULL,
                                'service_name' => isset($vendorItem['service']) ? $vendorItem['service']: NULL,
                                'packagin_group' => isset($vendorItem['packaging']) ? $vendorItem['packaging']: NULL,
                                'mode' => isset($vendorItem['mode']) ? $vendorItem['mode']: NULL,
                                'isActive' => isset($vendorItem['status']) ? $vendorItem['status']: 0,
                                'created_at' => date('Y-m-d h:s:i'),
                                'updated_at' => date('Y-m-d h:s:i'),
                            ];
                        }
                    }   
                }
                if(count($saveVendor) > 0){
                    VendorServiceType::insert($saveVendor);
                }
            }
        }
        
        
        if($result){
            return redirect()->back()->with('success','Vendor created successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }  

    }

    public function getVendorService(Request $request){
        $data = VendorServiceType::where('vendor_id',$request->id)->get();
        return json_encode($data);
    }

    public function vendorMasterDelete($id){
        // dd($id);
        $result = vendorMaster::where('id',$id)->delete();
        if($result){
            VendorServiceType::where('vendor_id',$id)->delete();
            return redirect()->back()->with('success','Record deleted successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }

    public function vendorAccountDetail(Request $request)
    {
         $editId = $request->query('id', 0);
        $vendorMaster = vendorMaster::select('id','name')->where('isActive',1)->get();
        $country = Country::where('isActive',1)->get();
        
        $vendorAccount = VendorAccountDetail::select('vendor_account_details.*','vendor_masters.name as vendor_name')
        ->join('vendor_masters','vendor_account_details.vendor_id','=','vendor_masters.id')
        ->whereNull('vendor_masters.deleted_at');
        $totalvendorAccount =$vendorAccount->count();
        $vendorAccount = $vendorAccount->paginate(env('page_default_val'));
        $editDetails = NULL;
        if($editId!=0){
            $editId;$editDetails = VendorAccountDetail::select('*')->whereNull('deleted_at')->where('id',$editId)->first();
        }
        
        return view('vendor_module.vendor_account_detail',compact('vendorMaster','country','vendorAccount','editDetails','totalvendorAccount'));
    }
    public function vendorAcccountSave(Request $request){

        $this->validate($request,[
            'vendor_id'=>'required',
            'token'=>'required',
            'meter_no'=>'required',
            'account_no'=>'required',
            'account_no1'=>'required',
            'environment'=>'required',
         ]);
       if($request->id!=0){
            $VendorAccountDetail = VendorAccountDetail::find($request->id);
            $msg = 'Vendor account details updated successfully!';
       }else{
            $VendorAccountDetail = new VendorAccountDetail;
            $msg = 'Vendor account details created successfully!';
       }
       $VendorAccountDetail->vendor_id = isset($request->vendor_id) ? $request->vendor_id : 0;
       $VendorAccountDetail->token = isset($request->token) ? $request->token : NULL;
       $VendorAccountDetail->meter_no = isset($request->meter_no) ? $request->meter_no : NULL;
       $VendorAccountDetail->account_no = isset($request->account_no) ? $request->account_no : NULL;
       $VendorAccountDetail->password = isset($request->password) ? $request->password : NULL;
       $VendorAccountDetail->account_no1 = isset($request->account_no1) ? $request->account_no1 : NULL;
       $VendorAccountDetail->environment = isset($request->environment) ? $request->environment : NULL;
       $VendorAccountDetail->isActive = isset($request->isActive) ? $request->isActive : 0;
       $VendorAccountDetail->company_name = isset($request->company_name) ? $request->company_name : NULL;
       $VendorAccountDetail->gst_no = isset($request->gst_no) ? $request->gst_no : NULL;
       $VendorAccountDetail->pincode = isset($request->pincode) ? $request->pincode : NULL;
       $VendorAccountDetail->contact_person = isset($request->contact_person) ? $request->contact_person : NULL;
       $VendorAccountDetail->address_1 = isset($request->address_1) ? $request->address_1 : NULL;
       $VendorAccountDetail->city_id = isset($request->city_id) ? $request->city_id : NULL;
       $VendorAccountDetail->email_id = isset($request->email_id) ? $request->email_id : NULL;
       $VendorAccountDetail->address_2 = isset($request->address_2) ? $request->address_2 : NULL;
       $VendorAccountDetail->state_id = isset($request->state_id) ? $request->state_id : NULL;
       $VendorAccountDetail->phone = isset($request->phone) ? $request->phone : NULL;
       $VendorAccountDetail->address_3 = isset($request->address_3) ? $request->address_3 : NULL;
       $VendorAccountDetail->country_id = isset($request->country_id) ? $request->country_id : NULL;
       $VendorAccountDetail->pickup_address = isset($request->pickup_address) ? $request->pickup_address : NULL;
       $result = $VendorAccountDetail->save();
        if($result){
            return redirect()->back()->with('success',$msg);
        }else{
            return redirect()->route()->with('error','Something went wrong please try again!');
        }
    }
    public function vendorAcccountDetailDelete($id){
        $result = VendorAccountDetail::where('id',$id)->update(['deleted_at'=>NOW()]);
        if($result){
            return redirect()->back()->with('success','Record deleted successfully!');
        }else{
            return redirect()->route()->with('error','Something went wrong please try again!');
        }
    }
    public function exportVendorAccountDetail(){
        $vendorAccount = VendorAccountDetail::select('vendor_account_details.*','vendor_masters.name as vendor_name')
        ->join('vendor_masters','vendor_account_details.vendor_id','=','vendor_masters.id')
        ->whereNull('vendor_masters.deleted_at')->get();
        $type = 'xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Vendor');
        $sheet->setCellValue('C1', 'Token');
        $sheet->setCellValue('D1', 'Meter No');
        $sheet->setCellValue('E1', 'Account No');
        $sheet->setCellValue('F1', 'Password');
        $sheet->setCellValue('G1', 'Account #1');
        $sheet->setCellValue('H1', 'Environment');
        $sheet->setCellValue('I1', 'Status');
       
        $rows = 2;
        $i=1;
        foreach($vendorAccount as $row){
        $sheet->setCellValue('A' . $rows, $i++);
        $sheet->setCellValue('B' . $rows, $row['vendor_name']);
        $sheet->setCellValue('C' . $rows, $row['token']);
        $sheet->setCellValue('D' . $rows, $row['meter_no']);
        $sheet->setCellValue('E' . $rows, $row['account_no']);
        $sheet->setCellValue('F' . $rows, $row['password']);
        $sheet->setCellValue('G' . $rows, $row['account_no1']);
        $sheet->setCellValue('H' . $rows, $row['environment']);
        $sheet->setCellValue('I' . $rows, ($row['isActive']==1?'Active':'Inactive'));
        $rows++;
        }
        $fileName = "vendor-account-details.".$type;
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
    public function exportVendorMaster(){
        $vendor = vendorMaster::select('vendor_masters.*','country.country_name')
        ->leftjoin('country','country.id','=','vendor_masters.country_id')
        ->whereNull('deleted_at')->get();
        $type = 'xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Vendor Code');
        $sheet->setCellValue('C1', 'Vendor Name');
        $sheet->setCellValue('D1', 'Address 1');
        $sheet->setCellValue('E1', 'Address 2');
        $sheet->setCellValue('F1', 'Pincode');
        $sheet->setCellValue('G1', 'City');
        $sheet->setCellValue('H1', 'State');
        $sheet->setCellValue('I1', 'Country');
        $sheet->setCellValue('J1', 'Email');
        $sheet->setCellValue('K1', 'Mobile No');
        $sheet->setCellValue('L1', 'GSTIN');
        $sheet->setCellValue('M1', 'Selft Vendor');
        $sheet->setCellValue('N1', 'Active');
        $sheet->setCellValue('O1', 'ThirdPartyTracking');
       
        $rows = 2;
        $i=1;
        foreach($vendor as $row){
        $sheet->setCellValue('A' . $rows, $i++);
        $sheet->setCellValue('B' . $rows, $row['vendor_code']);
        $sheet->setCellValue('C' . $rows, $row['name']);
        $sheet->setCellValue('D' . $rows, $row['address1']);
        $sheet->setCellValue('E' . $rows, $row['address2']);
        $sheet->setCellValue('F' . $rows, $row['pincode']);
        $sheet->setCellValue('G' . $rows, $row['city_id']);
        $sheet->setCellValue('H' . $rows, $row['state_id']);
        $sheet->setCellValue('I' . $rows, $row['country_name']);
        $sheet->setCellValue('J' . $rows, $row['email']);
        $sheet->setCellValue('K' . $rows, $row['mobile_no']);
        $sheet->setCellValue('L' . $rows, $row['gstin']);
        $sheet->setCellValue('M' . $rows, ($row['selfVendor']==1?'YES':'NO'));
        $sheet->setCellValue('N' . $rows, ($row['isActive']==1?'Active':'Inactive'));
        $sheet->setCellValue('O' . $rows, ($row['third_party_tracking']==1?'Active':'Inactive'));
        $rows++;
        }
        $fileName = "vendor-master.".$type;
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
