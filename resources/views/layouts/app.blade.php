<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Saita Logistics Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
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
  </head>
  
   <body>
      <div class="main-wrapper">
         <div class="account-page">
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
  
      </script>

        <script>
            function valueChanged() {
              if($('.coupon_question').is(":checked"))   
                $(".answer").show();
              else
                $(".answer").hide();
            };
        </script>
   </body>
</html>