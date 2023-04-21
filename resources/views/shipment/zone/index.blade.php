@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Zone Management</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Shipping Master</a></li>
                <li class="breadcrumb-item"><span> Zone Management</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="container-fluid p-2">
                        <div class="float-right">
                            <a class="btn btn-info" href="{{ route('import.zone.rates')}}">Import</a>
                            <a class="btn btn-info" href="{{ route('export.zone.rates')}}">Export</a>
                        </div>
                    </div>    
                    <div class="card-body">
                        <table class="table" id="example" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>Carrier type</th>
                                    <th>Zone counts</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $obj)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>
                                            <span class="badge badge-success">{{$obj}}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('view.carrier.zone', $key) }}" class="btn-sm btn-info">View</a>
                                        </td>
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
@endsection

@section('script')
@endsection