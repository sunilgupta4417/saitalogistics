<?php

namespace App\Http\Controllers;

use App\Models\ClientMaster;
use App\Models\ClientOtherCharges;
use App\Models\ClientContactPerson;
use App\Models\Country;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ClientMasterController extends Controller
{
    public function clientMaster(Request $request){
        $editId = $request->query('id',0);
        $country = Country::select('*')->where('isActive',1)->get();
        $clientMaster = ClientMaster::join('country','country.id','=','client_masters.country_id')
        ->select('client_masters.*','country.country_name')->whereNull('deleted_at');
        $totalClient = $clientMaster->count();
        $clientMaster =$clientMaster->paginate(env('page_default_val'));
        $client=null;$OtherCharges=null;
        if($editId!=0){
            $client = ClientMaster::select('*')->where('id',$editId)->first();
            $OtherCharges = ClientOtherCharges::select('*')->where('client_id',$editId)->get();
        }
        return view('client.client_master',compact('country','clientMaster','client','OtherCharges','totalClient'));
    }
    public function clientMasterSave(Request $request){

        $this->validate($request,[
            'country_name'=>'required',
            'client_name'=>'required',
            'client'=>'required',
            'address1'=>'required',
            'state_id'=>'required',
            'email_id'=>'required',
            'country_id'=>'required',
            'pincode'=>'required',
            'city_id'=>'required',
            
         ]);
         
        $id = $request->id;
        $insData = [
        'client_code'=>isset($request->client_code) ? $request->client_code : null,
        'client_name'=>isset($request->client_name) ? $request->client_name : null,
        'client'=>isset($request->client) ? $request->client : null,
        'address1'=>isset($request->address1) ? $request->address1 : null,
        'state_id'=>isset($request->state_id) ? $request->state_id : null,
        'email_id'=>isset($request->email_id) ? $request->email_id : null,
        'address2'=>isset($request->address2) ? $request->address2 : null,
        'country_id'=>isset($request->country_id) ? $request->country_id : null,
        'pan'=>isset($request->pan) ? $request->pan : null,
        'pincode'=>isset($request->pincode) ? $request->pincode : null,
        'mobile_no'=>isset($request->mobile_no) ? $request->mobile_no : null,
        'gstin'=>isset($request->gstin) ? $request->gstin : null,
        'city_id'=>isset($request->city_id) ? $request->city_id : null,
        'office_phone_no'=>isset($request->office_phone_no) ? $request->office_phone_no : null,
        'iec'=>isset($request->iec) ? $request->iec : null,
        'aadhaar_no'=>isset($request->aadhaar_no) ? $request->aadhaar_no : null,
        'bill_payment_type'=>isset($request->bill_payment_type) ? $request->bill_payment_type : null,
        'bill_credit_amount'=>isset($request->bill_credit_amount) ? $request->bill_credit_amount : null,
        'bill_isActive'=>isset($request->bill_isActive) ? $request->bill_isActive : 0,
        'bill_tax_applicable'=>isset($request->bill_tax_applicable) ? $request->bill_tax_applicable : 0,
        'bill_vol'=>isset($request->bill_vol) ? $request->bill_vol : null,
        'bill_currency'=>isset($request->bill_currency) ? $request->bill_currency : null,
        'bill_self_service'=>isset($request->bill_self_service) ? $request->bill_self_service : 0,
        'bill_mail_notification'=>isset($request->bill_mail_notification) ? $request->bill_mail_notification : 0,
        'bill_fuel_applicable'=>isset($request->bill_fuel_applicable) ? $request->bill_fuel_applicable : 0,
        'bill_enable_fedex_tpc'=>isset($request->bill_enable_fedex_tpc) ? $request->bill_enable_fedex_tpc : 0,
        'bill_generate_label'=>isset($request->bill_generate_label) ? $request->bill_generate_label : 0,
        'bill_no_invoice_amount'=>isset($request->bill_no_invoice_amount) ? $request->bill_no_invoice_amount : 0,
        ];
        if($id==0){
            $result = ClientMaster::create($insData);
            if(isset($request->Other) && count($request->Other) > 0){
                foreach($request->Other as $otherItem){
                    $saveVendor[] = [
                    'client_id' => $result->id,
                    'charge_type' => isset($otherItem['charge_type']) ? $otherItem['charge_type']: NULL,
                    'type' => isset($otherItem['type']) ? $otherItem['type']: NULL,
                    'amount_per' => isset($otherItem['amount_per']) ? $otherItem['amount_per']: 0,
                    'created_at' => date('Y-m-d h:s:i'),
                    'updated_at' => date('Y-m-d h:s:i'),
                    ];   
                }
                ClientOtherCharges::insert($saveVendor);
            }
            
            if(isset($request->contact) && count($request->contact) > 0){
                foreach($request->contact as $contactItem){
                    $saveContact[] = [
                    'client_id' => $result->id,
                    'contact_person_name' => isset($contactItem['contact_person_name']) ? $contactItem['contact_person_name']: NULL,
                    'mobile_no' => isset($contactItem['mobile_no']) ? $contactItem['mobile_no']: NULL,
                    'email_id' => isset($contactItem['email_id']) ? $contactItem['email_id']: null,
                    'created_at' => date('Y-m-d h:s:i'),
                    'updated_at' => date('Y-m-d h:s:i'),
                    ];   
                }
                ClientContactPerson::insert($saveContact);
            }
            if($result){
                return redirect()->back()->with('success','Client created successfully!');
            }else{
                return redirect()->back()->with('error','Something went wrong please try again!');
            }
        }else{
           
            $result = ClientMaster::where('id',$id)->update($insData);
            ClientOtherCharges::where('client_id',$id)->delete();
            // dd($request->Other);
            if(isset($request->Other) && count($request->Other) > 0){
                foreach($request->Other as $otherItem){
              
                    if(isset($otherItem['id']) && $otherItem['id'] > 0){
                        if(!empty($otherItem['amount_per'])){
                            $updateOther= [
                                // 'client_id' => $result->id,
                                'charge_type' => isset($otherItem['charge_type']) ? $otherItem['charge_type']: NULL,
                                'type' => isset($otherItem['type']) ? $otherItem['type']: NULL,
                                'amount_per' => isset($otherItem['amount_per']) ? $otherItem['amount_per']: 0,
                                'created_at' => date('Y-m-d h:s:i'),
                                'updated_at' => date('Y-m-d h:s:i'),
                                ];   
                            ClientOtherCharges::where('id',$otherItem['id'])->restore();
                            ClientOtherCharges::where('id',$otherItem['id'])->update($updateOther);   
                        }
                        // echo 'up;';
                    }else{
                        if(!empty($otherItem['amount_per'])){
                            $saveOtherData = [
                                'client_id' => $id,
                                'charge_type' => isset($otherItem['charge_type']) ? $otherItem['charge_type']: NULL,
                                'type' => isset($otherItem['type']) ? $otherItem['type']: NULL,
                                'amount_per' => isset($otherItem['amount_per']) ? $otherItem['amount_per']: 0,
                                'created_at' => date('Y-m-d h:s:i'),
                                'updated_at' => date('Y-m-d h:s:i'),
                                ];   

                            ClientOtherCharges::create($saveOtherData);
                        }
                        // dd   ('ins');
                        // echo 'ins';
                   }
                }

                // print_r($otherItem['id']); 

            }
            // exit;
            if($result){
                return redirect()->back()->with('success','Client created successfully!');
            }else{
                return redirect()->back()->with('error','Something went wrong please try again!');
            }
        }
    }
    public function clientMasterDelete($id){
        $result =ClientMaster::where('id',$id)->update(['deleted_at'=>NOW()]);
        if($result){
            return redirect()->back()->with('success','Client deleted successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }
    public function exportClientMaster(){
        $clientMaster = ClientMaster::join('country','country.id','=','client_masters.country_id')
        ->select('client_masters.*','country.country_name')->whereNull('deleted_at')->get();
        $type = 'xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Client Code');
        $sheet->setCellValue('C1', 'Client Name');
        $sheet->setCellValue('D1', 'Client');
        $sheet->setCellValue('E1', 'Address 1');
        $sheet->setCellValue('F1', 'Address 2');
        $sheet->setCellValue('G1', 'Pincode');
        $sheet->setCellValue('H1', 'City');
        $sheet->setCellValue('I1', 'State');
        $sheet->setCellValue('J1', 'Country');
        $sheet->setCellValue('K1', 'Email');
        $sheet->setCellValue('L1', 'Mobile No');
        $sheet->setCellValue('M1', 'GSTIN');
        $sheet->setCellValue('N1', 'IEC');
        $sheet->setCellValue('O1', 'Active');
        $sheet->setCellValue('P1', 'Aadhar No');
        $rows = 2;
        $i=1;
        foreach($clientMaster as $row){
        $sheet->setCellValue('A' . $rows, $i++);
        $sheet->setCellValue('B' . $rows, $row['client_code']);
        $sheet->setCellValue('C' . $rows, $row['client_name']);
        $sheet->setCellValue('D' . $rows, $row['client']);
        $sheet->setCellValue('E' . $rows, $row['address1']);
        $sheet->setCellValue('F' . $rows, $row['address2']);
        $sheet->setCellValue('G' . $rows, $row['pincode']);
        $sheet->setCellValue('H' . $rows, $row['city_id']);
        $sheet->setCellValue('I' . $rows, $row['state_id']);
        $sheet->setCellValue('J' . $rows, $row['country_name']);
        $sheet->setCellValue('K' . $rows, $row['email_id']);
        $sheet->setCellValue('L' . $rows, $row['mobile_no']);
        $sheet->setCellValue('M' . $rows, $row['gstin']);
        $sheet->setCellValue('N' . $rows, $row['iec']);
        $sheet->setCellValue('O' . $rows, ($row['bill_isActive']==1?'Active':'Inactive'));
        $sheet->setCellValue('P' . $rows, $row['aadhaar_no']);
        $rows++;
        }
        $fileName = "client-master.".$type;
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