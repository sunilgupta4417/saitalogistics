@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Country Master</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Master Management</a></li>
                <li class="breadcrumb-item"><span> Country Master</span></li>
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
                     <form action="{{ route('country.save')}}" method="post" name="country_frm" id="country_frm">
                        @csrf
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3> Country Master</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Country Code*</label>
                                   <input type="text" min="2" max="3" required class="form-control" name="country_code" id="country_code" placeholder="Enter Country Code">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Country Name*</label>
                                   <input type="text" required class="form-control" name="country_name" id="country_name" placeholder="Enter Country Name">
                                </div>

                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('country-master','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>@endif
                              @if(checkAccess('country-master','search_permission'))<button class="btn btn-primary mr-2" type="button"><i class="fa fa-search"></i> Search</button>@endif
                              @if(checkAccess('country-master','import_permission'))<a href="{{route('export.country')}}" class="btn btn-primary mr-2 btn-sm" type="button"><i class="fa fa-expand"></i> Export</a>@endif
                                 <button onclick="window.location.reload();" class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                              </div>
                            </div>
                        </div>
                     </form>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="bg-clr">
                              <div class="row">
                                 <div class="col-md-10">
                                 <div class="frm-heading">
                                        <h3>Total Country (s) Found: {{$totalCoutry}}</h3>
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
                                 </div>--}}
                              </div>
                           </div>
                             <div class="col-md-12">    
                                 <div class="x_content">
                                    <div class="table-responsive">
                                       <table id="t1">
                                             <thead>
                                                <tr>
                                                @if(checkAccess('country-master','edit_permission'))<th>Edit</th>@endif
                                                @if(checkAccess('country-master','delete_permission'))<th>Delete</th>@endif
                                                   <th>Country Code</th>
                                                   <th>Country Name</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             @foreach($country as $row)
                                             <tr>
                                             @if(checkAccess('country-master','edit_permission'))<td><a class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$row->id}}" href="#"> <i class="fa fa-pencil-alt"></i></a></td>@endif
                                             @if(checkAccess('country-master','delete_permission'))<td><a class="btn btn-primary" href="{{route('country.delete',$row->id)}}" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fa fa-trash-alt"></i></a></td>@endif
                                                <td>{{$row->country_code}}</td>
                                                <td>{{$row->country_name}}</td>
                                             </tr>
                                             <!-- Modal -->
                                                <div id="myModal{{$row->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                   <!-- Modal content-->
                                                   <div class="modal-content">
                                                      <div class="modal-header d-inline">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      <h4 class="modal-title">Edit Country</h4>
                                                      </div>
                                                      <form action="{{route('country.update')}}" name="country_frm_update" method="post">
                                                         @csrf
                                                         <div class="modal-body">
                                                            <div class="row">
                                                            <div class="form-group col-md-6 col-12">
                                                               <label>Country Code*</label>
                                                               <input type="text" value="{{$row->country_code}}" required  name="country_code" id="country_code" class="form-control" placeholder="Enter Country Code">
                                                               <input type="hidden" required class="form-control" value="{{$row->id}}" name="id" id="id">
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                               <label>Country Name*</label>
                                                               <input type="text" value="{{$row->country_name}}" required class="form-control" name="country_name" id="country_name"  placeholder="Enter Country Name">
                                                            </div>
                                                            </div>      
                                                         </div>
                                                         <div class="modal-footer">
                                                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                         <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                                </div>
                                             @endforeach
                                       </tbody>
                                       </table>
                                       
                                    </div>
                                    <div class="mt-3 float-right">
                                    {{ $country ->links() }}
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
    <script>
$(function () {
    var table = $('#t1').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax: "{{ route('country.list') }}",
        "order": [[5, "desc" ]],
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            
            {data: 'custom_date', name: 'custom_date'},
            {data: 'action', name: 'action',orderable: false,searchable: false},
            // /orderable: false, searchable: false
        ]
    });
  });
</script>
@endsection