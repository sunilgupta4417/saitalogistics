<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/favicon.png') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Saita-Logistics</title>
  <!-- Mobile Specific Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @include('frontend.layouts.partials.head_style')
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3JSBZNWB6F"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3JSBZNWB6F');
</script>
</head>
<body>
  <!-- preloader area start -->
  <div class="preloader" id="preloader">
    <div class="preloader-inner">
      <div class="spinner">
        <img src="https://saitamatoken.com/img/load.gif" alt="" style="width:20%; margin: 0 auto;">
      </div>
    </div>
  </div>
  <div class="body-overlay" id="body-overlay"></div>
  <!-- preloader area end -->
  @include('frontend.layouts.partials.header')
  <!-- sidebar -->
  @yield('page_content')
  <!-- footer -->
  <footer class="main-footer">
    @include('frontend.layouts.partials.footer')
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- body_script -->
@include('frontend.layouts.partials.body_script')
@yield('extra_body_scripts')
</body>
</html>
