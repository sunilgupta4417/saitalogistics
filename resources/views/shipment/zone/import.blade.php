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
                        <form action="{{route('doimport.zone.rates')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="csv-file">Select File</label>
                                <input type="file" name="csv-file" class="form-control" id="csv-file">
                            </div>
                            <div class="form-group">
                                <label for="carrier">Select carrier</label>
                                <select name="carrier" id="carrier" class="form-control">
                                    <option value="FEDEX">Fedex</option>
                                    <option value="DHL">DHL</option>
                                    <option value="UPS">UPS</option>
                                    <option value="ARAMAX">Aramex</option>
                                    <option value="DPD">DPD</option>
                                    <?php /*<option value="HKC">HKC</option>*/?>
                                </select>
                            </div>
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