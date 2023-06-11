  <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
  <!-- Icofont Css -->
  <link rel="stylesheet" href="{{asset('assets/plugins/themify/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.css')}}">
  <!-- animate.css -->
  <link rel="stylesheet" href="{{asset('assets/plugins/animate-css/animate.css')}}">
  <!-- Magnify Popup -->
  <link rel="stylesheet" href="{{asset('assets/plugins/magnific-popup/dist/magnific-popup.css')}}">
  <!-- Owl Carousel CSS -->


  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/fonts/stylesheet.css')}}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


  <style>
    .select2-container {
      margin-top: 6px;
      padding: 0 12px 0 58px;
      border: 2px solid #00000012;
      font-size: 16px;
      color: #404040;
      transition: 1ms;
      height: 62px;
      border-radius: 33px;
      display: block;
    }

    .select2-container--default .select2-selection--single {
      border: none !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 50px !important;
      right: 20px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 50px !important;
    }

    .select2-container--default .select2-selection--single {
      border-radius: 20px !important;
    }
  </style>
  @yield('head_style')