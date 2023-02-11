@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Reason Master</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Master Management</a></li>
                <li class="breadcrumb-item"><span> Reason Master</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
             @include('message.error_validation')
                   <div class="card-body">
                    <form action="{{route('reason.save')}}" method="post" id="reason_frm" name="reason_frm">
                        @csrf
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3> Reason Master</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-5 col-12">
                                   <label>Reason Code*</label>
                                   <input type="text" name="reason_code" id="reason_code" required class="form-control" placeholder="Enter Reason Code">
                                </div>
                                <div class="form-group col-md-5 col-12">
                                   <label>Reason*</label>
                                   <input type="text" name="reason_text" id="reason_text" required class="form-control" placeholder="Enter Reason">
                                </div>
                                <div class="form-group col-md-2 col-12 pr-0">
                                     <div class="all-chk">
                                         <label><input type="checkbox" name="isActive" id="isActive" value="1" checked> Active</label>
                                     </div>
                                </div>

                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('reason-master','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>@endif
                              @if(checkAccess('reason-master','import_permission'))<a href="{{route('export.reason')}}" class="btn btn-primary mr-2 btn-sm" type="button"><i class="fa fa-expand"></i> Export</a>@endif
                                 <button onclick="window.location.reload();" class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                              </div>
                            </div>
                        </div>
                    </form>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="bg-clr">
                             <div class="row">
                                <div class="col-md-3">
                                    <div class="frm-heading">
                                        <h3>No Record(s) Found: {{$total}}</h3>
                                    </div>
                                </div>
                                {{--<div class="col-md-2">
                                    <div class="searching-fld">
                                        <select class="form-control select">
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="searching-fld">
                                        <select class="form-control select">
                                            <option value="Reason Code">Reason Code</option>
                                            <option value="RM.Reason">Reason</option>
                                        </select>
                                    </div>
                                </div>--}}
                                {{--<div class="col-md-2">
                                    <div class="searching-fld">
                                        <select class="form-control select">
                                            <option value="1">Exactly</option>
                                            <option value="2">Contains</option>
                                            <option value="3">Start with</option>
                                        </select>
                                    </div>
                                </div>--}}
                                <div class="col-md-3">                
                                    <div class="search-container">
                                            <input type="text" placeholder="Search Here.." name="search">
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                             </div>

                             <div class="col-md-12">    
                                <div class="x_content">
                                    <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                            @if(checkAccess('reason-master','edit_permission'))<th>Edit</th>@endif
                                            @if(checkAccess('reason-master','delete_permission'))<th>Delete</th>@endif
                                                <th>Reason Code</th>
                                                <th>Reason</th>
                                                <th>Active</th>
                                                <th>Created By</th>
                                                <th>Created Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reason as $row)
                                            <?php
                                                if($row->isActive==1){
                                                    $isActive = 'Yes';
                                                }else{
                                                    $isActive = 'No';
                                                }
                                            ?>
                                            <tr>
                                            @if(checkAccess('reason-master','add_permission'))<td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal{{$row->id}}"> <i class="fa fa-pencil-alt"></i></a></td>@endif
                                            @if(checkAccess('reason-master','add_permission'))<td><a class="btn btn-primary" href="{{route('reason.delete',$row->id)}}" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fa fa-trash-alt"></i></a></td>@endif
                                                <td>{{$row->reason_code}}</td>
                                                <td>{{$row->reason_text}}</td>
                                                <td>{{$isActive}}</td>
                                                <td>{{$row->name}}</td>
                                                <td>{{$row->created_at}}</td>
                                            </tr>
                                            <div id="myModal{{$row->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                    <div class="modal-header d-inline">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Reason Update</h4>
                                                    </div>
                                                    <form action="{{route('reason.update')}}" method="post" id="reason_frm" name="reason_frm">
                                                    @csrf
                                                        <div class="modal-body">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="row">
                                                            <input type="hidden" name="id" value="{{$row->id}}" id="id" >
                                                                <div class="form-group col-md-5 col-12">
                                                                <label>Reason Code*</label>
                                                                <input type="text" name="reason_code" value="{{$row->reason_code}}" id="reason_code" required class="form-control" placeholder="Enter Reason Code">
                                                                </div>
                                                                <div class="form-group col-md-5 col-12">
                                                                <label>Reason*</label>
                                                                <input type="text" name="reason_text" id="reason_text"  value="{{$row->reason_text}}" required class="form-control" placeholder="Enter Reason">
                                                                </div>
                                                                <div class="form-group col-md-2 col-12 pr-0">
                                                                    <div class="all-chk">
                                                                        <label><input type="checkbox" <?php echo ($row->isActive==1?'checked':'')?> name="isActive" id="isActive" value="1"> Active</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Apply Changes</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                        </table>
                                        <div class="mt-3 float-right">
                                        {!! $reason->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                   
                </div>
             </div>
          </div>
       </div>
    </div>
@endsection