@extends('frontend.layouts.master')
@section('page_content')
<section id="login-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box">
                         @if(Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }} text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ Session::get('message') }}</strong>
            </div>
        @endif
                        <h2>Login</h2>
                       <form class="form-horizontal form-simple" action="{{ url('user/authenticate') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input type="email" id="email" name="email" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                 @endif
                            </div>
                            <div class="form-group locking">
                                <i class="fa fa-lock"></i>
                                <input type="password" id="password" name="password" placeholder="Password" required>
                                <i class="fa fa-eye showOrHide" ></i>
                                @if ($errors->has('password'))
                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                            <div class="for-text">
                                <a href="{{ url('user-forgot-password') }}" class="forgot">Forgot Password?</a>
                            </div>
                            <div class="sub-btns text-center">
                                <button type="submit" class="btn">Login</button>
                            </div>
                            <div class="social-buttons">
                               <!-- <ul>
                                    <li class="facebook-btn"><a href="#"><img src="assets/images/social-icon/facebook-btn.svg" alt="" class="img-responsive"> <span>Facebook</span></a></li>
                                    <li class="googel-btn"><a href="#"><img src="assets/images/social-icon/google-btn.svg" alt="" class="img-responsive"> <span>Google</span></a></li>
                                </ul> -->
                            </div>
                            <div class="have-account">
                                <a href="{{ url('user-register') }}" class="hv-text">Don't have an account? <b>Create an account</b></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('extra_body_scripts')
    <script>
        $('.showOrHide').click(function(e){
            var target = e.currentTarget
            $(target).hasClass('show')?hidePassword($(target)):showPassword($(target))
        })
        function hidePassword(e){
            e.removeClass('show').addClass('hide')
            e.prev('input').attr('type','password')
        }
        function showPassword(e){
            e.removeClass('hide').addClass('show')
            e.prev('input').attr('type','text')
        }
    </script>
@endsection


