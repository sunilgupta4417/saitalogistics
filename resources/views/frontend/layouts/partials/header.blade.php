    <!-- NAVBAR
    ================================================= -->
    <div class="main-navigation main_menu " id="mainmenu-area">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('assets/images/logo-white.png')}}" alt="Digicon" class="img-fluid">
                </a>
                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-menu-alt"></span>
                </button>

                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <!-- Links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item ">
                            <a href="{{ url('about') }}" class="nav-link js-scroll-trigger">About us</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ url('services') }}" class="nav-link js-scroll-trigger">Services</a>
                        </li>
                        <li class="nav-item dropdown" id="sep-dropdown">
                            <a href="{{ url('shipping') }}" class="nav-link dropdown-toggle">
                                Shipping
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbar3">
                                <a href="{{ route('user.create_courier_shipment') }}" class="nav-link">Courier Shipment</a>
                                <a href="{{ route('user.create_air_shipment') }}" class="nav-link">Air Freight Shipment</a> 
                                <a href="{{ route('user.create_ocean_shipment') }}" class="nav-link">Ocean Shipment</a> 
                            </div>
                        </li>
                       <!--  <li class="nav-item ">
                            <a href="{{ url('tracking') }}" class="nav-link js-scroll-trigger">Tracking</a>
                        </li> -->
                        <li class="nav-item ">
                            <a href="{{ url('support') }}" class="nav-link">Support</a>
                        </li>
                    </ul>

                     <ul class="list-inline header-contact float-lg-right">
                        <li class="list-inline-item center-icons" id="head-icons">
                           <a href="#" class="btn btn-solid-border btn-sm mb-lg-0 mb-2"><i class="fab fa-facebook-f"></i></a>
                           <a href="https://twitter.com/SaitaLogistics" target="_blank" class="btn btn-solid-border btn-sm mb-lg-0 mb-2"><i class="fab fa-twitter"></i></a>
                           <a href="https://www.instagram.com/explore/tags/saitalogistics" target="_blank" class="btn btn-solid-border btn-sm mb-lg-0 mb-2"><i class="fab fa-instagram"></i></a>
                        </li> 
                        @if(Auth::check() && Auth::user()->role_id == 0 ) 
                        <li class="list-inline-item nav-item dropdown" id="head-icons">
                            <a href="#" class="nav-link dropdown-toggle" id="navbar3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}} 
                                {{-- <img src="{{asset('assets/images/user2.png')}}" alt=""> --}}
                                @if(Auth::user()->profile_pic==NULL)
                                    <img src="{{asset('assets/images/user2.png')}}" alt="">
                                @else
                                    <img src="{{asset('assets/images/profile/'.Auth::user()->profile_pic.'')}}" alt="" class="img-responsive" style="border-radius:50%" height="35" width="35">
                                @endif
                                <i class="fa fa-caret-down"></i></a>
                            <div class="dropdown-menu" aria-labelledby="navbar3">
                                 <a class="dropdown-item" href="{{ url('user/dashboard') }}">
                                    My Profile
                                </a>
                                <a class="dropdown-item" href="{{ url('user/shipment/history') }}">
                                    History
                                </a> 
                                <a class="dropdown-item" href="{{route('user.transactions')}}">
                                    Transaction
                                </a> 
                                <a class="dropdown-item" href="{{ url('user-logout') }}">
                                    Logout
                                </a> 
                            </div>
                        </li> 
                        @else
                        <li class="list-inline-item" id="head-icons">
                            <a href="{{ url('user-login') }}" class="btn btn-main-2 btn-sm">Sign Up/Log In</a>
                        </li> 
                        @endif
                        <li class="list-inline-item">
                         <a href="https://saitamatoken.com" target="_blank"> <img src="{{asset('assets/images/saita-icon.svg')}}" alt="" class="img-responsive"> </a>
                        </li>
                    </ul>
                </div> <!-- / .navbar-collapse -->
            </nav>
        </div> <!-- / .container -->
    </div>