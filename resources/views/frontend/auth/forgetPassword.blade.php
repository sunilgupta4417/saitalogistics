@extends('frontend.layouts.app')
@section('content')
    {{-- <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>@lang('message.form.forget-password-form')</h1>
                </div>
            </div>
        </div>
    </section> --}}
    <!--End banner Section-->

    <!-- Content ==== -->
    <div id="content">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-9 col-lg-8 col-xl-7 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <h3 class="font-weight-400 text-center mb-4">@lang('message.form.forget-password-form')</h3>
                        <hr class="mx-n5">

                        @include('frontend.layouts.common.alert')
                    
                        <form ction="{{ url('forget-password') }}" method="post" id="forget-password-form">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="email">@lang('message.form.email')</label>
                                <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="@lang('message.form.email')" name="email" id="email">
                            </div>

                            <button class="btn btn-theme btn-block my-4" id="forget-password-submit-btn" type="submit"> 
                                <i class="spinner fa fa-spinner fa-spin" style="display: none;"></i>
                                <span id="forget-password-submit-btn-text" style="font-weight: bolder;">
                                    @lang('message.form.submit')
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection

@section('js')
    <script src="{{asset('public/frontend/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script>

        jQuery.extend(jQuery.validator.messages, {
            required: "{{__('This field is required.')}}",
            email: "{{__("Please enter a valid email address.")}}",
        });

        $('#forget-password-form').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                }
            },
            submitHandler: function(form)
            {
                $("#forget-password-submit-btn").attr("disabled", true).click(function (e)
                {
                    e.preventDefault();
                });
                $(".spinner").show();
                $("#forget-password-submit-btn-text").text("{{__('Submitting...')}}");
                form.submit();
            }
        });
    </script>

@endsection