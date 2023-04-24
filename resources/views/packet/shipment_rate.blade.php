@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Shipment Rate</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Operation Management</a></li>
                <li class="breadcrumb-item"><span> Shipment Rate</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               <form action="{{route('shipment.get.rate')}}" method="post">
                  @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Get Shipment rates:</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Origin</label>
                                    <input type="text" class="form-control" name="origin" value="Germany" readonly id="origin">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Destination</label>
                                    <select class="form-control" name="destination" id="destination" required>
                                        @foreach($country as $obj)
                                         @if(session()->get('data'))
                                          @php 
                                             $data = session()->get('data');
                                           @endphp
                                          <option value="{{$obj->id}}" {{$obj->country == $data['destination'] ? 'selected' : ''}}>{{$obj->country}}</option>
                                       @else
                                          <option value="{{$obj->id}}">{{$obj->country}}</option>
                                       @endif
                                       @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Packet type</label>
                                    <select id="select-service" name="package_type" required class="form-control">
                                       <option></option>
                                       <option value="Envelope">Envelope</option>
                                       <option value="Documents">Documents</option>
                                       <option value="Non-Documents">Non Documents</option>
                                    </select>
                                 </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Mode</label>
                                   <select class="form-control">
                                        <!-- <option value="import" disabled>Import</option> -->
                                        <option value="export" selected>Export</option>
                                   </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>weight</label>
                                   <input type="text" name="weight" id="weight" class="form-control" required>
                                </div>
                           </div>
                         </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group"> 
                                <button value="invoice" class="getVal btn btn-primary mr-2" type="submit"><i class="fa fa-file-import"></i> Submit</button>
                                <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                              </div>
                            </div>
                        </div>
                        @if(session()->get('data'))
                        @php 
                            $data = session()->get('data');
                        @endphp
                        @if(isset($data['warning']))
                        <div class="alert alert-warning">
                           {{$data['warning']}}
                        </div>
                        @endif
                            <div class="alert alert-success">
                                <p><b>Origin : </b>{{$data['origin']}}</p>
                                <p><b>Destination : </b>{{$data['destination']}}</p>
                                <p><b>Weight : </b>{{$data['weight']}}</p>
                                <p><b>Mode : </b>EXPORT</p>
                                <br>
                                @if(isset($data['Fedex']))
                                 <p><b>RATES Fedex : </b><i class="fas fa-euro-sign"></i> {{$data['Fedex']['rate']}}</p>
                                @endif
                                @if(isset($data['DHL']))
                                 <p><b>RATES DHL : </b><i class="fas fa-euro-sign"></i> {{$data['DHL']['rate']}}</p>
                                @endif
                                @if(isset($data['UPS']))
                                 <p><b>RATES UPS : </b><i class="fas fa-euro-sign"></i> {{$data['UPS']['rate']}}</p>
                                @endif
                                @if(isset($data['AMX']))
                                 <p><b>RATES ARAMEX : </b><i class="fas fa-euro-sign"></i> {{$data['AMX']['rate']}}</p>
                                @endif
                                @if(isset($data['DPD']))
                                 <p><b>RATES DPD : </b><i class="fas fa-euro-sign"></i> {{$data['DPD']['rate']}}</p>
                                @endif
                            </div>
                        @endif
                     </div>
                   </form>
                  </div>
             </div>
          </div>
       </div>
    </div>
@endsection