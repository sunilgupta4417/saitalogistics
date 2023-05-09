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
                <li class="breadcrumb-item"><a href="#">Shipping Master</a></li>
                <li class="breadcrumb-item"><span>Zone Management</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('zone.update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{last(request()->segments())}}">
                            @foreach($data[0] as $key => $obj)
                                @if($key == 'carrier_type')
                                <div class="form-group">
                                    <label>Carrier type</label>
                                    <input type="text" name="carrier_type" id="carrier_type" value="{{$obj}}" readonly class="form-control">
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="{{$key}}">{{ ucwords(str_replace("_"," ",$key)) }}</label>
                                    <input type="text" name="{{$key}}" id="{{$key}}" value="{{$obj}}" class="form-control">
                                </div>
                                @endif
                            @endforeach
                            <div class="form-group">
                                <input type="submit" class="btn btn-success float-right"  value="Submit">
                                <br>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
       </div>
    </div>
@endsection

@section('script')
@endsection