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
                        <p>
                            <input type="radio" name="carrier_type" checked value="ALL" class="carrier_type"> <label for="carrier_type"> ALL</label>
                            <input type="radio" name="carrier_type" value="FEDEX" class="carrier_type"> <label for="carrier_type"> FEDEX</label>
                            <input type="radio" name="carrier_type" value="DHL" class="carrier_type"> <label for="carrier_type"> DHL</label>
                            <input type="radio" name="carrier_type" value="UPS" class="carrier_type"> <label for="carrier_type"> UPS</label>
                            <input type="radio" name="carrier_type" value="ARAMEX" class="carrier_type"> <label for="carrier_type"> ARAMEX</label>
                        </p>
                    </div>    
                    <form action="{{route('role-manager.store')}}" method="post">
                    @csrf
                        <div class="card-body">
                            <table class="table" id="example">
                                <thead>
                                    <tr>
                                        <th>Sr. no</th>
                                        <th>Weight</th>
                                        <th>Carrier type</th>
                                        @foreach($zone as $obj)
                                            <th>{{$obj}}</th>
                                        @endforeach
                                        <th>Action</th>
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
                                        <td><a href="{{ route('zone.edit', $obj['id']) }}" class="btn-sm btn-info">Edit</a></td>
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
<style>
    .table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#example').DataTable();
        $('.carrier_type').change(function () {
            if (this.value == 'ALL') {
                table.search('');
                table.columns().search('').draw();
            } else {
                table.columns(2).search(this.value).draw();   
            }
        });
    });
</script>
@endsection