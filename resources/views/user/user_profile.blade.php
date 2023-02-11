@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">User Profile</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Setting Management</a></li>
                <li class="breadcrumb-item"><span> User Profile</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               <form action="{{route('user.profile.update')}}" method="post" name="user_profile" id="user_profile" enctype="multipart/form-data" >
                   <div class="card-body">
                    @csrf
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Your Profile:</h3>
                                 </div>
                               </div>
                           </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="row">
                                <div class="form-group col-md-2 col-4">
                                     <div class="user-detail">
                                         <p>User Code:</p>
                                     </div>
                                </div>
                                <div class="form-group col-md-7 col-8">
                                     <div class="user-detail">
                                         <p>{{$user->user_code}}</p>
                                     </div>
                                </div>
                             </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="row">
                                <div class="form-group col-md-2 col-4">
                                     <div class="user-detail">
                                         <p>User Name:</p>
                                     </div>
                                </div>
                                <div class="form-group col-md-7 col-8">
                                     <div class="user-detail">
                                         <p>{{$user->name}}</p>
                                     </div>
                                </div>
                             </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="row">
                                <div class="form-group col-md-2 col-4">
                                     <div class="user-detail">
                                         <p>Mobile No.:</p>
                                     </div>
                                </div>
                                <div class="form-group col-md-7 col-8">
                                     <div class="user-detail">
                                         <p>{{$user->mobile_no}}</p>
                                     </div>
                                </div>
                             </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="row">
                                <div class="form-group col-md-2 col-4">
                                     <div class="user-detail">
                                         <p>Email ID:</p>
                                     </div>
                                </div>
                                <div class="form-group col-md-7 col-8">
                                     <div class="user-detail">
                                         <p>{{$user->email}}</p>
                                     </div>
                                </div>
                             </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="row">
                                <div class="form-group col-md-2 col-4">
                                     <div class="user-detail">
                                         <p>Address:</p>
                                     </div>
                                </div>
                                <div class="form-group col-md-7 col-8">
                                     <div class="user-detail">
                                         <textarea type="text" name="address" class="form-control" placeholder="Address">{{$user->address}}</textarea>
                                     </div>
                                </div>
                             </div>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="row">
                                <div class="form-group col-md-2 col-4">
                                     <div class="user-detail">
                                         <p>Profile Pic.:</p>
                                     </div>
                                </div>
                                <?php
                                if($user->profile_pic!=''){
                                    $profile_pic = asset('logistics/user/'.$user->profile_pic);
                                }else{
                                    $profile_pic = asset('admin/img/user-06.jpg');
                                }?> 
                                <div class="form-group col-md-5 col-5">
                                     <div class="user-detail">
                                         <input type="file" class="form-control" name="profile_pic">
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-3">
                                     <div class="user-image">
                                         <img src="{{$profile_pic}}" alt="" class="img-responsive">
                                     </div>  
                                </div>
                             </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('user-profile','edit_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>@endif
                                 <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                              </div>
                            </div>
                        </div>
                     </div>
                   </form></div>
               
             </div>
          </div>
       </div>
    </div>
@endsection