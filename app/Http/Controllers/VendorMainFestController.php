<?php

namespace App\Http\Controllers;

use App\Models\VendorMainFest;
use Illuminate\Http\Request;

class VendorMainFestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor_main_fest.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $this->validate($request,[
            'booking_date'=>'required',
            'forwarder'=>'required',
            'date'=>'required',
            'remark'=>'required',
         ]);
         
         $data = [
            'booking_date' => isset($request->booking_date) ? $request->booking_date : null,
            'forwarder' => isset($request->forwarder) ? $request->forwarder : null,
            'mani_fest_date' => isset($request->date) ? $request->date : null,
            'remark' => isset($request->remark) ? $request->remark : null,
            'awbno' => isset($request->awbno) ? $request->awbno : null,
            'is_update' => isset($request->is_update)?0:1,
         ];

         if(isset($request->is_update) && $request->is_update=='on'){
            $data['mani_fest_no'] = $request->no;
         }else{
            $data['mani_fest_no'] = time();
         }

        $result= VendorMainFest::create($data);
        if($result){
            return redirect()->back()->with('success','Vendor Main fest created successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorMainFest  $vendorMainFest
     * @return \Illuminate\Http\Response
     */
    public function show(VendorMainFest $vendorMainFest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorMainFest  $vendorMainFest
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorMainFest $vendorMainFest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorMainFest  $vendorMainFest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorMainFest $vendorMainFest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorMainFest  $vendorMainFest
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorMainFest $vendorMainFest)
    {
        //
    }
}
