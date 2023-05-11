@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-md-6">
        <h3 class="page-title mb-0">Dashboard</h3>
      </div>
      <div class="col-md-6">
        <ul class="breadcrumb mb-0 p-0 float-right">
          <li class="breadcrumb-item">
            <a href="{{ url('/') }}">
              <i class="fas fa-home"></i> Home </a>
          </li>
          <li class="breadcrumb-item">
            <span>Dashboard</span>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
      <div class="dash-widget dash-widget5" id="box1">
        <span class="float-left">
          <img src="{{ asset('admin/img/dash/dash-1.png') }}" alt="" width="80">
        </span>
        <div class="dash-widget-info text-right">
          <span>PACKET BOOKING</span>
          <h3>{{$booking->count()}}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
      <div class="dash-widget dash-widget5" id="box2">
        <div class="dash-widget-info text-left d-inline-block">
          <span>REGISTERED USERS</span>
          <h3>0</h3>
        </div>
        <span class="float-right">
          <img src="{{ asset('admin/img/dash/dash-2.png') }}" width="80" alt="">
        </span>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
      <div class="dash-widget dash-widget5" id="box3">
        <span class="float-left">
          <img src="{{ asset('admin/img/dash/dash-3.png') }}" alt="" width="80">
        </span>
        <div class="dash-widget-info text-right">
          <span>PACKET STATUS</span>
          <h3>0</h3>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-6 d-flex">
      <div class="card flex-fill">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-auto" id="clr-blk">
              <div class="page-title"> Country - Total Shipment </div>
            </div>
            <div class="col text-right">
              <div class=" mt-sm-0 mt-2">
                <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#">Action</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div id="chart1"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 d-flex">
      <div class="card flex-fill">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-auto" id="clr-blk">
              <div class="page-title"> Month - Total Shipment </div>
            </div>
            <div class="col text-right">
              <div class=" mt-sm-0 mt-2">
                <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#">Action</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div id="chart2"></div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {

    var options = {
      series: [{
        name: "Value $",
        data: <?= $chart1data ?>
      }],
      chart: {
        height: 450,
        type: 'line',
        zoom: {
          enabled: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight'
      },
      markers: {
        size: 6,
        colors: ["#00B871"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        }
      },
      colors: ["#00B871"],
      grid: {
        row: {
          colors: ['transparent', 'transparent'],
          opacity: 0.5
        },
      },
      xaxis: {
        categories: <?= $chart1labels ?>,
      },
    };
    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();
    var options = {
      series: [{
        name: "Value $",
        data: <?= $chart2data ?>
      }],
      chart: {
        height: 450,
        type: 'line',
        zoom: {
          enabled: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight'
      },
      markers: {
        size: 6,
        colors: ["#00B871"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        }
      },
      colors: ["#8944D7"],
      grid: {
        row: {
          colors: ['transparent', 'transparent'],
          opacity: 0.5
        },
      },
      xaxis: {
        categories: <?= $chart2labels ?>,
      },
    };
    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();

  });
</script>
@endsection