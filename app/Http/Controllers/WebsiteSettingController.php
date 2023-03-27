<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    
    public function websiteSetting()
    {
        $website = WebsiteSetting::select('*')->get()->pluck('data_value','data_key')->toArray();
        return view('website_setting.web_setting',compact('website'));
    }
    public function websiteSettingSave(Request $request){
       
        $allData = $request->data;
        $imageArray = ['company_logo','company_dashboard_img'];
        // dd($request->data->hasFile('company_logo'));
        if(count($allData)>0){
            foreach($allData as $key =>$value){
                $checkData = WebsiteSetting::select('id','data_value')->where('data_key',$key)->first();
                if($checkData){
                    $updateData = [
                        'data_value'=>$value
                    ];
                    if(in_array($key,$imageArray)){
                            $destinationPath = 'logistics/website/';   
                            $delete_pic = public_path($destinationPath.$checkData->data_value);
                            if (file_exists($delete_pic)) {
                                @unlink($delete_pic);
                            }
                            $image_name = 'company_'.time().'.';
                            $myimage = $value->getClientOriginalName();
                            $myimage = $image_name.$value->getClientOriginalExtension();
                            $value->move(public_path($destinationPath), $myimage); 
                            $updateData['data_value'] = $myimage;
                    }
                    WebsiteSetting::where('id',$checkData->id)->update($updateData);
                }else{
                    $createData=[
                        'data_key'=>$key,
                        'data_value'=>$value,
                    ];
                    WebsiteSetting::create($createData);
                }
            }
        }
        return redirect()->back()->with('success','Website details updated successfully!');
    }
}
