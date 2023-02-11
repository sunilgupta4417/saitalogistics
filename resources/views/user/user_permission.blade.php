@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Role Permission - {{ $detail->name}}</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><span> Role Permission</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               <form action="{{route('save.user-permission')}}" method="post">
                @csrf
                   <div class="card-body">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="col-md-12">    
                            <div class="x_content">
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Module Name</th>
                                                <th style="text-align: center;">View</th>
                                                <th style="text-align: center;">Add</th>
                                                <th style="text-align: center;">Edit</th>
                                                <th style="text-align: center;">Search</th>
                                                <th style="text-align: center;">Import / Export</th>
                                                <th style="text-align: center;">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php 
                                            $module = [
                                                        "packet-booking",
                                                        "import-packet",
                                                        "print-awb-document",
                                                        "vendor-manifest",
                                                        "shipment-movement",
                                                        "pod-upload",
                                                        "client-master",
                                                        "vendor-master",
                                                        "vendor-account-detail",
                                                        "zone-master",
                                                        "country-master",
                                                        "reason-master",
                                                        "booking-report",   
                                                        "manifest-report",
                                                        "delivered-report",
                                                        "manage-users",
                                                        "role-manager",
                                                        "change-password",
                                                        "create-invoice",
                                                        "invoice",
                                                        "website-setting",
                                                        "payment-history",
                                                        "user-profile",
                                                        "vendor-api-configuration"
                                                    ];
                                        @endphp
                                        @foreach($module as $key=>$item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>
                                                    {{ ucfirst(str_replace("-"," ",$item)) }}
                                                    <input type="hidden" class="form-control" name="module[{{ $key }}][name]" value="{{ $item }}">
                                                    <input type="hidden" class="form-control" name="module[{{ $key }}][user_id]" value="{{ $detail->id }}">
                                                </td>
                                                <td><input type="checkbox" class="form-control" {{ (isset($permissionData[$item]['view']) && $permissionData[$item]['view']==0?'checked':'') }} name="module[{{ $key }}][view]" value="0"></td>
                                                <td><input type="checkbox" class="form-control" {{ (isset($permissionData[$item]['add']) && $permissionData[$item]['add']==0?'checked':'') }} name="module[{{ $key }}][add]" value="0"></td>
                                                <td><input type="checkbox" class="form-control" {{ (isset($permissionData[$item]['edit']) && $permissionData[$item]['edit']==0?'checked':'') }} name="module[{{ $key }}][edit]" value="0"></td>
                                                <td><input type="checkbox" class="form-control" {{ (isset($permissionData[$item]['search']) && $permissionData[$item]['search']==0?'checked':'') }} name="module[{{ $key }}][search]" value="0"></td>
                                                <td><input type="checkbox" class="form-control" {{ (isset($permissionData[$item]['import']) && $permissionData[$item]['import']==0?'checked':'') }} name="module[{{ $key }}][import]" value="0"></td>
                                                <td><input type="checkbox" class="form-control" {{ (isset($permissionData[$item]['delete']) && $permissionData[$item]['delete']==0?'checked':'') }} name="module[{{ $key }}][delete]" value="0"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                         
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                 <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                 {{-- <button  onclick="window.location.reload();" class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</a> --}}
                              </div>
                            </div>
                        </div>

                        
                     </div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
@endsection

