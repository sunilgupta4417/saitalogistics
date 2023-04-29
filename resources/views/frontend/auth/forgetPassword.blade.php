@extends('frontend.layouts.master')
@section('page_content')
<section id="login-page">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="login-box">
					@if(Session::has('status'))
						<div class="alert {{ Session::get('alert-class') }} text-center">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>{{ Session::get('status') }}</strong>
						</div>
					@endif
				        <h2>Forgot Password</h2>
				        <p class="enter-number">Enter Your Registered Email Id</p>
				        <form method="POST" action="{{ route('user.forget.password.link') }}">
                            @csrf
				            <div class="form-group select-code">
				            	
				                <i class="fa fa-envelope-square"></i>
				                <input type="text" name="email" placeholder="Email" required>
				            </div>
				            <br>
					        <div class="sub-btns text-center">
					            <button type="submit" class="btn">Submit</button>
					        </div>
				        </form>
				    </div>
				</div>
			</div>
		</div>
	</section>
@endsection