@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">User Master</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> User Management</a></li>
                <li class="breadcrumb-item"><span> User Master</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
             @include('message.error_validation')
                <?php 
                $user_id = isset($user->id) ? $user->id : 0;
                $status = isset($user->status) ? $user->status : 0;
                if($user_id!=0){
                    $req = '';
                    $url = route('user.master.update');
                }else{
                    $req = 'required';
                    $url = route('user.master.save');
                }
                ?>
               <form action="{{$url}}" method="post" name="user_frm" id="user_frm">
                @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>User Master:</h3>
                                 </div>
                               </div>
                                <!-- <div class="form-group col-md-12 col-12">
                                     <label>Consignee*</label>
                                     <input class="form-control" type="text" value="System Generated" disabled>
                                </div> -->
                                <!-- <div class="form-group col-md-12 col-12">
                                     <label>AWB No.*</label>
                                     <textarea type="text" class="form-control" placeholder="Accepts multiple AWB No. comma(,) seperated or enter seperated"></textarea>
                                </div> -->
                                <!-- <div class="form-group col-md-6 col-12">
                                     <div class="nw-cls">
                                         <div class="question">
                                            <label><input class="coupon_question" type="checkbox" name="coupon_question" value="1" onchange="valueChanged()"/> Client Login</label>
                                         </div>
                                         <div class="answer">
                                             <label>User Group*</label>
                                             <select class="form-control select">
                                                <option>--Select Status--</option>
                                                <option value="INTRANSIT">INTRANSIT</option>
                                                <option value="DELIVERED">DELIVERED</option>
                                                <option value="UN-DELIVERED">UN-DELIVERED</option>
                                                <option value="RTO">RTO</option>
                                                <option value="PICKED UP">PICKED UP</option>
                                             </select>
                                             <div class="all-chk">
                                                 <label><input type="checkbox"> IsMain</label>
                                             </div>
                                         </div>
                                     </div>
                                </div>-->
                                
                                <div class="form-group col-md-3 col-12">
                                   <input type="hidden" value="{{$user_id}}" name="id" id="id">
                                     <label>User Name*</label>
                                     <input class="form-control" value="{{(isset($user->name) ? $user->name : null)}}" type="text" name="name" id="name" required placeholder="Enter User Name">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                     <label>Mobile No*</label>
                                     <input class="form-control" value="{{(isset($user->mobile_no) ? $user->mobile_no : null)}}" type="text" name="mobile_no" id="mobile_no" placeholder="Enter Mobile No">
                                </div>
                                <!-- <div class="form-group col-md-3 col-12">
                                     <label>User Group*</label>
                                     <select class="form-control select" disabled>
                                        <option>-- Select Group --</option>
                                        <option value="INTRANSIT">INTRANSIT</option>
                                        <option value="DELIVERED">DELIVERED</option>
                                        <option value="UN-DELIVERED">UN-DELIVERED</option>
                                        <option value="RTO">RTO</option>
                                        <option value="PICKED UP">PICKED UP</option>
                                     </select>
                                </div> -->
                               
                                <div class="form-group col-md-3 col-12">
                                     <label>Password*</label>
                                     <input class="form-control" type="text" {{$req}} name="password" id="password" placeholder="Enter Password">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                     <label>DOJ*</label>
                                     <input class="form-control datetimepicker-input datetimepicker" value="{{(isset($user->doj) ? $user->doj : null)}}" name="doj" id="doj" type="text" data-toggle="datetimepicker">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                     <label>Email ID*</label>
                                     <input class="form-control" value="{{(isset($user->email) ? $user->email : null)}}" type="text" name="email" id="email" placeholder="Enter Email ID">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                     <label>Status*</label>
                                     <select class="form-control select" name="status" id="status">
                                        <option value="1" <?php echo ($status==1 ? 'selected' : '')?>>Active</option>
                                        <option value="0" <?php echo ($status== 0 ? 'selected' : '')?>>InActive</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3 col-12">
                                    <label>User Role*</label>
                                    <select class="form-control select" name="role_id" id="role_id">
                                        @foreach($role as $key=>$userRole)
                                            @if(isset($user->role_id))
                                                <option value="{{ $key }}" <?php echo ($user->role_id==$key ? 'selected' : '')?>>{{ $userRole }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $userRole }}</option>
                                            @endif
                                        @endforeach
                                   </select>
                               </div>
                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                 @if(checkAccess('manage-users','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>@endif
                                 @if(checkAccess('manage-users','import_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-expand"></i> Export</button>@endif
                                 <a class="btn btn-secondary orng-btn" style="font-size:inherit;" href="{{route('manage.user')}}"><i class="fa fa-dot-circle"></i> Reset</a>
                              </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="bg-clr">
                             <div class="row">
                                <div class="col-md-3">
                                    <div class="frm-heading">
                                        <h3>Total Record(s) Found: {{$users->count()}}</h3>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="searching-fld">
                                        <select class="form-control select">
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                @if(checkAccess('manage-users','search_permission'))
                                <div class="col-md-2">
                                    <div class="searching-fld">
                                        <select class="form-control select">
                                            <option value="User Code">User Code</option>
                                            <option value="User Name">User Name</option>
                                            <option value="Mobile Number">Mobile Number</option>
                                            <option value="Email ID">Email ID</option>
                                            <option value="User Group Name">User Group Name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="searching-fld">
                                        <select class="form-control select">
                                            <option value="1">Exactly</option>
                                            <option value="2">Contains</option>
                                            <option value="3">Start with</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">                
                                    <div class="search-container">
                                            <input type="text" placeholder="Search Here.." name="search">
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                @endif
                            </div>
                             </div>
                             <div class="col-md-12">    
                                <div class="x_content">
                                    <div class="table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    @if(checkAccess('manage-users','edit_permission'))<th>Edit</th>@endif
                                                    @if(checkAccess('manage-users','delete_permission')) <th>Delete</th>@endif
                                                    <th>Permission</th>
                                                    <th>User Name</th>
                                                    @if(auth()->user()->role_id==2)<th>Role</th>@endif
                                                    <th>DOJ</th>
                                                    <th>Mobile No</th>
                                                    <th>Email ID</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $rowu)
                                            <tr>
                                                @if(checkAccess('manage-users','edit_permission'))<td><a class="btn btn-primary" href="{{route('manage.user')}}?id={{$rowu->id}}"> <i class="fa fa-pencil-alt"></i></a></td>@endif
                                                @if(checkAccess('manage-users','delete_permission'))<td><a class="btn btn-primary" href="{{route('user.delete',$rowu->id)}}" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fa fa-trash-alt"></i></a></td>@endif
                                                <td><a class="btn btn-primary" href="{{route('user.user-permission',$rowu->id)}}"> <i class="fa fa-sitemap"></i></a></td>
                                                <td>{{ $rowu->name }}</td>
                                                @if(auth()->user()->role_id==2)<td>{{ $role[$rowu->role_id] }}</td>@endif
                                                <td>{{ $rowu->doj }}</td>
                                                <td>{{ $rowu->mobile_no }}</td>
                                                <td>{{ $rowu->email }}</td>
                                                <td>{{ ($rowu->status==1?'Yes':'No') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
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