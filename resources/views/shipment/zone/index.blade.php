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
                    <form action="{{route('role-manager.store')}}" method="post">
                    @csrf
                        <div class="card-body">
                            <div class="justify-content-end">
                                  <a class="btn btn-info" href="{{ route('import.zone.rates')}}">Import</a>
                                  <a class="btn btn-info" href="{{ route('export.zone.rates')}}">Export</a>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sr. no</th>
                                        <th>Weight</th>
                                        <th>Carrier type</th>
                                        @foreach($zone as $obj)
                                            <th>{{$obj}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $obj)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$obj['weight']}}</td>
                                        <td>{{$obj['carrier_type']}}</td>
                                        @foreach($zone as $obj2)
                                            <td>{{$obj[$obj2]}}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                </div>
            </div>
       </div>
    </div>
@endsection

@section('script')
@endsection