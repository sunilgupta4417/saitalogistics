@extends('frontend.layouts.master')
@section('page_content')
        <section id="login-page" class="profile-page-start">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-box">
                        <div class="profile-box-heading-img">
                            <h2>My Profile</h2>
                             @if(Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }} text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ Session::get('message') }}</strong>
            </div>
        @endif
        @if($errors->any())
        <div class="alert {{ Session::get('alert-class') }} text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ implode('', $errors->all(':message')) }}</strong>
            </div>
    
@endif
                            @if($user->profile_pic==NULL)
                                <img src="{{asset('assets/images/user.png')}}" alt="" class="img-responsive">
                            @else
                                <img src="{{asset('assets/images/profile/'.$user->profile_pic.'')}}" alt="" class="img-responsive" style="width: 200px;
    border-radius: 90%;
    border: 5px solid black;
    height: 200px;">
                            @endif
                            
                        </div>
                        <div class="profile-change-icon">
                            <a href="#" onclick="$('#mypic').click()"><img src="{{asset('assets/images/cng-icon.png')}}" alt="" class="img-responsive"></a>
                        </div>
                        <form class="form-horizontal form-simple" action="{{ url('user/profile/update') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input type="file" name="file" style="display:none" id="mypic"/>
                                <input type="text" id="name" name="name" value="{{$user->name}}" required>
                            </div>
                            <div class="form-group select-code">
                                <select name="phn_code" id="select-code">
                                    <option value="+91" <?php echo ($user->phn_code=="+91")?"selected='selected'":"";?>>+91</option>
                                    <option value="+92" <?php echo ($user->phn_code=="+92")?"selected='selected'":"";?>>+92</option>
                                    <option value="+93" <?php echo ($user->phn_code=="+93")?"selected='selected'":"";?>>+93</option>
                                    <option value="+94" <?php echo ($user->phn_code=="+94")?"selected='selected'":"";?>>+94</option>
                                </select>
                                <i class="fa fa-mobile"></i>
                                <input type="text" id="mobile" name="mobile" value="{{$user->mobile_no}}" required>
                            </div>
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input type="email" name="email" value="{{$user->email}}" readonly required>
                            </div>
                            <br>
                            <div class="sub-btns text-center">
                                <button type="submit" class="btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="change-password">
                        <a href="#" data-toggle="modal" data-target="#myModal"> <img src="{{asset('assets/images/locking.png')}}" alt="" class="img-responsive"> <span>Change Password</span> <img src="{{asset('assets/images/change-right-arrow.svg')}}" alt="" class="rht-arrows img-responsive"></a> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="change-password">
                <div class="sign-btns text-center">
                            <a href="{{ url('user-logout') }}" class="btn"> <img src="{{asset('assets/images/account-logout.svg')}}"> Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!-- Modal -->
<div class="modal fade change-password-p" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="login-page">
            <div class="profile-change-pass-popup">
                <div class="login-box">
                    <form class="form-horizontal form-simple" action="{{ url('user/profile/password') }}" method="POST">
                            {{ csrf_field() }}
                        <div class="form-group locking">
                            <img src="{{asset('assets/images/pass-chng.png')}}" alt="">
                            <input type="password" id="password" name="old_password" placeholder="Current Password" required>
                        </div>
                        <div class="form-group locking">
                            <img src="{{asset('assets/images/pass-chng.png')}}" alt="">
                            <input type="password" id="password" name="new_password" placeholder="Password" required>
                        </div>
                        <div class="form-group locking">
                            <img src="{{asset('assets/images/pass-chng.png')}}" alt="">
                            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
                        </div>
                        <div class="sub-btns text-center">
                            <button type="submit" class="btn">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>  
    </div>
</div>
@endsection
