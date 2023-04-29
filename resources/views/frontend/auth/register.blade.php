@extends('frontend.layouts.master')
@section('page_content')
<section id="login-page" class="signup-page">
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
                    <h2>Let's Get Started</h2>
                    <form class="form-horizontal form-simple" action="{{ url('user/register') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <i class="fa fa-user"></i>
                            <input type="text" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <select name="country" id="country" class="form-control" required>
                                <option value="">Please Select Country</option>
                                @foreach($country as $country_data)
                                <option value="{{$country_data->mobile_code}}">{{$country_data->country_name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group select-code">
                            <select name="code" id="select-code" style="pointer-events: none;">
                                <option value=""></option>
                                @foreach($country as $country_data)
                                <option value="{{$country_data->mobile_code}}">{{$country_data->mobile_code}}</option>
                                @endforeach
                            </select>
                            <i class="fa fa-mobile"></i>
                            <input type="text" id="mobile" name="mobile" placeholder="Mobile No" required>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-user"></i>
                            <input type="email" id="email" name="email" placeholder="Email ID" required>
                        </div>
                        <div class="form-group locking">
                            <i class="fa fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group locking">
                            <i class="fa fa-lock"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                        <div class="form-group agreed-text">
                            <label class="container">
                                <p>I have agreed to <b><a href="{{ url('terms-condition') }}">Terms & conditions</a></b> and<a href="{{ url('privacy-policy') }}"> <b>Privacy Policy</b></a></p>
                                <input type="radio" name="privacy" required>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="sub-btns text-center">
                            <button type="submit" class="btn">Signup</button>
                        </div>
                        <br><br>
                        <div class="have-account">
                            <a href="{{ url('user-login') }}" class="hv-text">Already have an account? <b>Login here</b></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('extra_body_scripts')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    $('#country').change(function() {
        $('#select-code').val($(this).val())
    })
</script>

@endsection