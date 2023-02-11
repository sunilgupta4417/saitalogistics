@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Role Manager</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> User Management</a></li>
                <li class="breadcrumb-item"><span> Role Manager</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               <form action="{{route('role-manager.store')}}" method="post">
                @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Role Master</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Name*</label>
                                   <input type="hidden" value="0" name="id" id="id" class="form-control">
                                   <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                                </div>
                           </div>
                         </div>
                         <hr>
                        @if(checkAccess('role-manager','add_permission'))
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-btns">
                                <div class="form-group text-center custom-mt-form-group">
                                    <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                    <button  onclick="window.location.reload();" class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</a>
                                </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="bg-clr">
                             <div class="row">
                                <div class="col-md-3">
                                    <div class="frm-heading">
                                        <h3>Total Role (s) Found: {{ $data->count() }}</h3>
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
                                


                            </div>
                             </div>

                            <div class="col-md-12">    
                                <div class="x_content">
                                    <div class="table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    @if(checkAccess('role-manager','edit_permission'))<th>Edit</th>@endif
                                                    @if(checkAccess('role-manager','delete_permission'))<th>Delete</th>@endif
                                                    @if(auth()->user()->role_id==2)<th>Permission</th>@endif
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $rowz)
                                                <tr>
                                                    @if(checkAccess('role-manager','edit_permission'))<td><a class="btn btn-primary editData" href="javascript:void(0);" data-name="{{ $rowz->name }}" data-id="{{ $rowz->id }}"> <i class="fa fa-pencil-alt"></i></a></td>@endif
                                                    @if(checkAccess('role-manager','delete_permission'))<td><a class="btn btn-primary" href="{{route('role-manager.delete',$rowz->id)}}" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fa fa-trash-alt"></i></a></td>@endif
                                                    @if(auth()->user()->role_id==2)<td><a class="btn btn-primary" href="{{route('role-manager.role-permission',$rowz->id)}}"> <i class="fa fa-sitemap"></i></a></td>@endif
                                                    <td>{{$rowz->name}}</td>
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

@section('script')
<script>
   $(document).ready(function() {
     $(".editData").on("click",function(){
        var id = $(this).data('id');
        var name = $(this).data('name');

        $("#id").val(id);
        $("#name").val(name);
     });
   });

</script>
@endsection