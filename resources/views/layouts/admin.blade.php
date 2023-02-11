<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Saita Logistics Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datetimepicker/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datetimepicker/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <script src="{{ asset('admin/js/jquery-3.5.1.min.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
  </head>
  
  <body>
    <div class="main-wrapper">
      <div class="header-outer">
        <div class="header">
          <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar">
            <i class="fas fa-bars" aria-hidden="true"></i>
          </a>
          <a id="toggle_btn" class="float-left" href="javascript:void(0);">
            <img src="{{ asset('admin/img/sidebar/icon-21.png') }}" alt="">
          </a>
          <ul class="nav float-left">
            <li>
              <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                  <i class="fa fa-search"></i>
                </a>
                <form action="">
                  <input class="form-control" type="text" placeholder="Search here">
                  <button class="btn" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </form>
              </div>
            </li>
            <li>
              <a href="{{ url('/admin//') }}" class="mobile-logo d-md-block d-lg-none d-block">
                <img src="{{ asset('admin/img/logo.png') }}" alt="" width="30" height="30">
              </a>
            </li>
          </ul>
          <ul class="nav user-menu float-right">
            <li class="nav-item dropdown d-none d-sm-block">
              <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <img src="{{ asset('admin/img/sidebar/icon-22.png') }}" alt="">
              </a>
              <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                  <span>Notifications</span>
                </div>
                <div class="drop-scroll">
                  <ul class="notification-list">
                    <li class="notification-message">
                      <a href="javascript:void(0);">
                        <div class="media">
                          <span class="avatar">
                            <img alt="John Doe" src="{{ asset('admin/img/user-06.jpg') }}" class="img-fluid rounded-circle">
                          </span>
                          <div class="media-body">
                            <p class="noti-details">
                              <span class="noti-title">John Doe</span> is now following you
                            </p>
                            <p class="noti-time">
                              <span class="notification-time">4 mins ago</span>
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li class="notification-message">
                      <a href="javascript:void(0);">
                        <div class="media">
                          <span class="avatar">T</span>
                          <div class="media-body">
                            <p class="noti-details">
                              <span class="noti-title">Tarah Shropshire</span> sent you a message.
                            </p>
                            <p class="noti-time">
                              <span class="notification-time">6 mins ago</span>
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li class="notification-message">
                      <a href="javascript:void(0);">
                        <div class="media">
                          <span class="avatar">L</span>
                          <div class="media-body">
                            <p class="noti-details">
                              <span class="noti-title">Misty Tison</span> like your photo.
                            </p>
                            <p class="noti-time">
                              <span class="notification-time">8 mins ago</span>
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li class="notification-message">
                      <a href="javascript:void(0);">
                        <div class="media">
                          <span class="avatar">G</span>
                          <div class="media-body">
                            <p class="noti-details">
                              <span class="noti-title">Rolland Webber</span> booking appoinment for meeting.
                            </p>
                            <p class="noti-time">
                              <span class="notification-time">12 mins ago</span>
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li class="notification-message">
                      <a href="javascript:void(0);">
                        <div class="media">
                          <span class="avatar">T</span>
                          <div class="media-body">
                            <p class="noti-details">
                              <span class="noti-title">Bernardo Galaviz</span> like your photo.
                            </p>
                            <p class="noti-time">
                              <span class="notification-time">2 days ago</span>
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="topnav-dropdown-footer">
                  <a href="javascript:void(0);">View all Notifications</a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown d-none d-sm-block">
              <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link">
                <img src="{{ asset('admin/img/sidebar/icon-23.png') }}" alt="">
              </a>
            </li>
            <li class="nav-item dropdown has-arrow">
              <a href="javascript:void(0);" class="nav-link user-link" data-toggle="dropdown">
                <span class="user-img"> 
                  @php
                    if(auth()->user()->profile_pic!=''){
                      $profile_pic = asset('logistics/user/'.auth()->user()->profile_pic);
                    }else{
                      $profile_pic = asset('admin/img/user-06.jpg');
                    }
                  @endphp
                  <img class="rounded-circle" src="{{ $profile_pic }}" width="30" alt="Admin">
                  <span class="status online"></span>
                </span>
                <span>{{ auth()->user()->name }}</span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('/admin//user-profile') }}">My Profile</a>
                {{-- <a class="dropdown-item" href="javascript:void(0);">Edit Profile</a> --}}
                <a class="dropdown-item" href="{{ url('/admin//change-password') }}">Change Password</a>
                <a class="dropdown-item" href="{{ url('/admin//website-setting') }}">Settings</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
              </div>
            </li>
          </ul>
          <div class="dropdown mobile-user-menu float-right">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ url('/admin//user-profile') }}">My Profile</a>
                <a class="dropdown-item" href="{{ url('/admin//change-password') }}">Change Password</a>
                {{-- <a class="dropdown-item" href="javascript:void(0);">Edit Profile</a> --}}
                <a class="dropdown-item" href="{{ url('/admin//website-setting') }}">Settings</a>
                <a class="dropdown-item" href="javascript:void(0);">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <div class="sidebar" id="sidebar">
         <div class="sidebar-inner slimscroll">
           <div id="sidebar-menu" class="sidebar-menu">
             <div class="header-left">
               <a href="{{ url('/home') }}" class="logo">
                 <img src="{{ asset('admin/img/logo.png') }}" style="width: 100%" width="auto" height="auto" alt="">
               </a>
             </div>
             <ul class="sidebar-ul">
               <li class="menu-title">Menu</li>

               <li class="{{ Request::segment(1)=='home'?'active':'' }}">
                 <a href="{{ url('/home') }}">
                   <i class="fa fa-th-large"></i>
                   <span>Dashboard</span>
                 </a>
               </li>

               @php 
                  $operation_menu = ['packet-booking','import-packet','print-awb-document','vendor-manifest','shipment-movement','pod-upload'];
                  $accessMenu = mainMenu();
               @endphp
               @if(array_intersect($operation_menu, $accessMenu))
               <li class="submenu">
                 <a href="javascript:void(0);" class="{{ in_array(Request::segment(2), $operation_menu)?'subdrop':'' }}">
                  <i class="fa fa-cogs"></i>
                   <span> Operation Management</span>
                   <span class="menu-arrow"></span>
                 </a>
                 <ul class="list-unstyled" style="{{ in_array(Request::segment(2), $operation_menu)?'':'display: none;' }}">
                    @if(in_array("packet-booking",$accessMenu))
                      <li class="{{ Request::segment(2)=='packet-booking'?'active':'' }}">
                          <a href="{{ url('/admin/packet-booking') }}">
                              <span>Packet Booking</span>
                          </a>
                      </li>
                    @endif
                    @if(in_array("import-packet",$accessMenu))
                      <li class="{{ Request::segment(2)=='import-packet'?'active':'' }}">
                        <a href="{{ url('/admin/import-packet') }}">
                            <span>Import Packet</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("print-awb-document",$accessMenu))
                      <li class="{{ Request::segment(2)=='print-awb-document'?'active':'' }}">
                        <a href="{{ url('/admin/print-awb-document') }}">
                            <span>Print AWB Document</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("vendor-manifest",$accessMenu))
                      <li class="{{ Request::segment(2)=='vendor-manifest'?'active':'' }}">
                        <a href="{{ url('/admin/vendor-manifest') }}">
                            <span>Manifest to Vendor</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("shipment-movement",$accessMenu))
                      <li class="{{ Request::segment(2)=='shipment-movement'?'active':'' }}">
                        <a href="{{ url('/admin/shipment-movement') }}">
                            <span>Shipment Movement</span>
                        </a>
                      </li>
                    @endif
                    <!-- <li class="{{ Request::segment(2)=='pod-upload'?'active':'' }}">
                      <a href="{{ url('/admin/pod-upload') }}">
                          <span>POD Upload</span>
                      </a>
                    </li> -->
                 </ul>
               </li>
               @endif

                @php 
                  $client_menu = ['client-master','vendor-master','vendor-account-detail','zone-master','country-master','reason-master'];
                @endphp
              @if(array_intersect($client_menu, $accessMenu))
               <li class="submenu">
                 <a href="javascript:void(0);" class="{{ in_array(Request::segment(2), $client_menu)?'subdrop':'' }}">
                  <i class="fa fa-database"></i>
                   <span> MASTER MANAGEMENT </span>
                   <span class="menu-arrow"></span>
                 </a>

                 <ul class="list-unstyled" style="{{ in_array(Request::segment(2), $client_menu)?'':'display: none;' }}">
                    @if(in_array("client-master",$accessMenu))
                      <li class="{{ Request::segment(2)=='client-master'?'active':'' }}">
                          <a href="{{ url('/admin/client-master') }}">
                              <span>Client Master</span>
                          </a>
                      </li>
                    @endif
                    @if(in_array("vendor-master",$accessMenu))
                      <li class="{{ Request::segment(2)=='vendor-master'?'active':'' }}">
                        <a href="{{ url('/admin/vendor-master') }}">
                            <span>Vendor Master</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("vendor-account-detail",$accessMenu))
                      <li class="{{ Request::segment(2)=='vendor-account-detail'?'active':'' }}">
                        <a href="{{ url('/admin/vendor-account-detail') }}">
                            <span>Vendor Account Details</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("zone-master",$accessMenu))
                      <li class="{{ Request::segment(2)=='zone-master'?'active':'' }}">
                        <a href="{{ url('/admin/zone-master') }}">
                            <span>Zone Master</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("country-master",$accessMenu))
                      <li class="{{ Request::segment(2)=='country-master'?'active':'' }}">
                        <a href="{{ url('/admin/country-master') }}">
                            <span>Country Master</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("reason-master",$accessMenu))
                      <li class="{{ Request::segment(2)=='reason-master'?'active':'' }}">
                        <a href="{{ url('/admin/reason-master') }}">
                            <span>Reason Master</span>
                        </a>
                      </li>
                    @endif
                 </ul>
               </li>
              @endif

              @php 
                $report_menu = ['booking-report','manifest-report','delivered-report'];
              @endphp
              @if(array_intersect($report_menu, $accessMenu))
               <li class="submenu">
                 <a href="javascript:void(0);" class="{{ in_array(Request::segment(2), $report_menu)?'subdrop':'' }}">
                  <i class="fa fa-retweet"></i>
                   <span> REPORTS MANAGEMENT </span>
                   <span class="menu-arrow"></span>
                 </a>
                 <ul class="list-unstyled" style="{{ in_array(Request::segment(2), $report_menu)?'':'display: none;' }}">
                    @if(in_array("booking-report",$accessMenu))
                      <li class="{{ Request::segment(2)=='booking-report'?'active':'' }}">
                          <a href="{{ url('/admin/booking-report') }}">
                              <span>Booking Report</span>
                          </a>
                      </li>
                    @endif
                    @if(in_array("v",$accessMenu))
                      <li class="{{ Request::segment(2)=='manifest-report'?'active':'' }}">
                        <a href="{{ url('/admin/manifest-report') }}">
                            <span>Manifest Report</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("delivered-report",$accessMenu))
                      <li class="{{ Request::segment(2)=='delivered-report'?'active':'' }}">
                        <a href="{{ url('/admin/delivered-report') }}">
                            <span>Delivered Report</span>
                        </a>
                      </li>
                    @endif
                 </ul>
               </li>
              @endif

              @php 
                $user_menu = ['change-password','manage-users','role-manager'];
              @endphp
              @if(array_intersect($user_menu, $accessMenu))
               <li class="submenu">
                 <a href="javascript:void(0);" class="{{ in_array(Request::segment(2), $user_menu)?'subdrop':'' }}">
                  <i class="fa fa-users"></i>
                   <span> USER MANAGEMENT </span>
                   <span class="menu-arrow"></span>
                 </a>
                 <ul class="list-unstyled" style="{{ in_array(Request::segment(2), $user_menu)?'':'display: none;' }}">
                    @if(in_array("manage-users",$accessMenu))
                      <li class="{{ Request::segment(2)=='manage-users'?'active':'' }}">
                          <a href="{{ url('/admin/manage-users') }}">
                              <span>Manage Users</span>
                          </a>
                      </li>
                    @endif
                    @if(in_array("role-manager",$accessMenu))
                      <li class="{{ Request::segment(2)=='role-manager'?'active':'' }}">
                        <a href="{{ url('/admin/role-manager') }}">
                            <span>Role Manager</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("change-password",$accessMenu))
                      <li class="{{ Request::segment(2)=='change-password'?'active':'' }}">
                        <a href="{{ url('/admin/change-password') }}">
                            <span>Change Password</span>
                        </a>
                      </li>
                    @endif
                 </ul>
               </li>
              @endif

              @php 
                $account_menu = ['invoice','create-invoice'];
              @endphp
              @if(array_intersect($account_menu, $accessMenu))
               <li class="submenu">
                 <a href="javascript:void(0);" class="{{ in_array(Request::segment(2), $account_menu)?'subdrop':'' }}">
                  <i class="fa fa-users"></i>
                   <span> Accounts </span>
                   <span class="menu-arrow"></span>
                 </a>
                 <ul class="list-unstyled" style="{{ in_array(Request::segment(2), $account_menu)?'':'display: none;' }}">
                    @if(in_array("create-invoice",$accessMenu))
                      <li class="{{ Request::segment(2)=='create-invoice'?'active':'' }}">
                          <a href="{{ url('/admin/create-invoice') }}">
                              <span>Create Invoice</span>
                          </a>
                      </li>
                    @endif
                    @if(in_array("invoice",$accessMenu))
                      <li class="{{ Request::segment(2)=='invoice'?'active':'' }}">
                        <a href="{{ url('/admin/invoice') }}">
                            <span>Invoice</span>
                        </a>
                      </li>
                    @endif
                 </ul>
               </li>
              @endif

              @php 
               $setting_menu = ['website-setting','payment-history','user-profile','vendor-api-configuration'];
              @endphp
              @if(array_intersect($setting_menu, $accessMenu))
               <li class="submenu">
                 <a href="javascript:void(0);" class="{{ in_array(Request::segment(2), $setting_menu)?'subdrop':'' }}">
                  <i class="fa fa-cog"></i>
                   <span> SETTINGS MANAGEMENT </span>
                   <span class="menu-arrow"></span>
                 </a>
                 <ul class="list-unstyled" style="{{ in_array(Request::segment(2), $setting_menu)?'':'display: none;' }}">
                    @if(in_array("website-setting",$accessMenu))
                      <li class="{{ Request::segment(2)=='website-setting'?'active':'' }}">
                          <a href="{{ url('/admin/website-setting') }}">
                              <span>Website Setting </span>
                          </a>
                      </li>
                    @endif
                    @if(in_array("payment-history",$accessMenu))
                      <li class="{{ Request::segment(2)=='payment-history'?'active':'' }}">
                        <a href="{{ url('/admin/payment-history') }}">
                            <span>Payment History</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("user-profile",$accessMenu))
                      <li class="{{ Request::segment(2)=='user-profile'?'active':'' }}">
                        <a href="{{ url('/admin/user-profile') }}">
                            <span>Your Profile</span>
                        </a>
                      </li>
                    @endif
                    @if(in_array("vendor-api-configuration",$accessMenu))
                      <li class="{{ Request::segment(2)=='vendor-api-configuration'?'active':'' }}">
                        <a href="{{ url('/admin/vendor-api-configuration') }}">
                            <span>Vendor API Configuratio</span>
                        </a>
                      </li>
                    @endif
                 </ul>
               </li>
              @endif
             </ul>
           </div>
         </div>
        </div>

      <div class="page-wrapper">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block mb-0">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
        </div>
      @endif
      @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block mb-0">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        @yield('content')
      </div>
    </div>

      <script src="{{ asset('admin/js/jquery-3.6.0.min.js') }}"></script>
      <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('admin/js/jquery.slimscroll.js') }}"></script>
      <script src="{{ asset('admin/js/select2.min.js') }}"></script>
      <script src="{{ asset('admin/js/moment.min.js') }}"></script>
      <script src="{{ asset('admin/js/fullcalendar.min.js') }}"></script>
      <script src="{{ asset('admin/js/jquery.fullcalendar.js') }}"></script>
      <script src="{{ asset('admin/plugins/morris/morris.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/raphael/raphael-min.js') }}"></script>
      <script src="{{ asset('admin/js/apexcharts.js') }}"></script>
      <script src="{{ asset('admin/js/chart-data.js') }}"></script>
      <script src="{{ asset('admin/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>
      <script src="{{ asset('admin/js/app.js') }}"></script>
      <script>

        $('#otherCheckbox').on('click',function() {
            var cb = $('#otherCheckbox').is(':checked');
            $('#other').prop('disabled', !cb);  
        });
  
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      </script>

        <script>
            function valueChanged() {
              if($('.coupon_question').is(":checked"))   
                $(".answer").show();
              else
                $(".answer").hide();
            };
        </script>
        @yield('script')
  </body>
</html>