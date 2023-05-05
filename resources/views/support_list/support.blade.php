@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title">Support List</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#"> Support List</a></li>
                    <li class="breadcrumb-item"><span> Support</span></li>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="bg-clr">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="frm-heading">
                                            <h3>Total Record(s) Found: {{$supports->count()}}</h3>
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
                                                    <th>#</th>
                                                    <th>Name</th>   
                                                    <th>Mobile No</th>
                                                    <th>Email ID</th>
                                                    <th>Company</th>
                                                    <th>Message</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($supports as $key=>$rowu)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $rowu->name }}</td>
                                                    <td>{{ $rowu->phoneno }}</td>
                                                    <td>{{ $rowu->email }}</td>
                                                    <td>{{ $rowu->company }}</td>
                                                    <td>{{ $rowu->message }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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