<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\EmailController;
use Illuminate\Support\Facades\Password;
use App\Http\Helpers\Common;
use App\Models\{
    User,
    };
use Illuminate\Support\Facades\{Artisan, 
    Session,
    Hash, 
    Auth,
    DB,
    Validator
};
use Exception;



class AuthController extends Controller
{
    protected $helper;
    protected $email;
    protected $user;
    public function __construct()
    {
        $this->helper = new Common();
        $this->email  = new EmailController();
        $this->user   = new User();
    }

    public function login()
    {
        return view('frontend.auth.login');
    }
    public function register()
    {
        return view('frontend.auth.register');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        $isUser = User::where('email', $request['email'])->where('role_id', 1)->first();
        if (!$isUser) {
            $this->helper->one_time_message('danger', 'Please Check Your Email/Password');
            return redirect()->route('user.login');
        }
            if (Auth::guard('web')->attempt(['email' => trim($request['email']), 'password' => trim($request['password'])]))
            {
                return redirect()->route('user.dashboard');
            }
            else
            {
                $this->helper->one_time_message('danger', 'Please Check Your Email/Password');
                return redirect()->route('user.login');
            }
        
    }


    public function store(Request $request)
    {
        $rules = array(
                    'name'            => 'required',
                    'email'                 => 'required|email|unique:users,email',
                    'mobile'                 => 'required',
                    'password'              => 'required|confirmed',
                    'password_confirmation' => 'required',
                );

                $fieldNames = array(
                    'name'            => 'First Name',
                    'email'                 => 'Email',
                    'mobile'                 => 'Mobile',
                    'password'              => 'Password',
                    'password_confirmation' => 'Confirm Password',
                ); 
            

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);
            if ($validator->fails())
            {
                return back()->withErrors($validator)->withInput();
            }
            else
            {
                try
                {
                    DB::beginTransaction();
                    
                            $model =  new User;        
                    $user = $model->createNewUser($request);
                    $subject = 'Notice for User Verification!';
                    $message = '<div style="padding:0!important;margin:0!important;display:block!important;min-width:100%!important;width:100%!important;background:#ffffff">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
      <tbody><tr>
          <td align="center" valign="top">
              
              <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#272727">
                  <tbody><tr>
                      <td style="font-size:0pt;line-height:0pt;text-align:left" width="1"></td>
                      <td align="center" style="background-image: linear-gradient(70deg,#009cde 0%,#71ccf3 25%,#141c28 35%,#141c28 65%,#5dc5f1 75%,#141c28 100%);">
                          <table width="650" border="0" cellspacing="0" cellpadding="0" bgcolor="#272727">
                              <tbody><tr>
                                  <td style="width:650px;min-width:650px;font-size:0pt;line-height:0pt;padding:0;margin:0;font-weight:normal;Margin:0">
                                      <table width="650" border="0" cellspacing="0" cellpadding="0" bgcolor="#03b67a">
                                          <tbody><tr>
                                              <td style="width:650px;min-width:650px;font-size:0pt;line-height:0pt;padding:0;margin:0;font-weight:normal;Margin:0">
  
  
                                                  
                                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#009cde">
                                          <tbody><tr>
                                              <td style="font-size:0pt;line-height:0pt;text-align:left" width="1"></td>
                                              <td>
                                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%"><tbody><tr><td height="30" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%">&nbsp;</td></tr></tbody></table>
  
                                                  <div>
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%"><tbody><tr><td height="10" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%">&nbsp;</td></tr></tbody></table>
  
                                                  </div>
                                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tbody><tr>
                                                          
                                                          <th style="font-size:0pt;line-height:0pt;padding:0;margin:0;font-weight:normal;Margin:0" width="300">
                                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tbody><tr>
                                                                      <td>
                                                                          <div style="font-size:0pt;line-height:0pt;text-align:center"><div style="font-size:0pt;line-height:0pt;text-align:center"><a href="#" rel="noreferrer noreferrer"><img style="width:250px;height:aut0" src="https://saitalogistics.tech/assets/images/logo-white.png" border="0" width="220" height="65" alt="" class="CToWUd"></a></div></div>
                                                                          <div style="font-size:0pt;line-height:0pt"></div>
  
                                                                      </td>
                                                                  </tr>
                                                              </tbody></table>
                                                          </th>
                                                          
                                                          
                                                         
                                                          
                                                      </tr>
                                                  </tbody></table>
                                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%"><tbody><tr><td height="40" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%">&nbsp;</td></tr></tbody></table>
  
                                              </td>
                                              <td style="font-size:0pt;line-height:0pt;text-align:left" width="1"></td>
                                          </tr>
                                      </tbody></table>
                                      
                                  </td>
                              </tr>
                          </tbody></table>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%">
                              <tbody><tr>
                                  <td width="650" align="center">
  
                                      <table width="650" border="0" cellspacing="0" cellpadding="0">
                                          <tbody><tr>
                                              <td>
  
                                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#272727">
                                                      <tbody><tr>
                                                          <td style="font-size:0pt;line-height:0pt;text-align:left" width="30"></td>
                                                          <td>
                                                              <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%"><tbody><tr><td height="20" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%">&nbsp;</td></tr></tbody></table>
  
                                                              <div style="color:#f6f6f6;font-family:Arial,sans-serif;font-size:26px;line-height:34px;text-align:center">Hi {user},</div>
                                                              <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%"><tbody><tr><td height="20" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%">&nbsp;</td></tr></tbody></table>
  
  
                                                              <div style="color:#f6f6f6;font-family: sans-serif;font-size: 18px;
                                                              line-height: 26px;
                                                              text-align: center;">Thank you for choosing us and welcome to Saita Logistics! Your registered Email ID is: {email}. Please click on the button below to verify your account:
                                                              </div>

                                                              <div style="color:#f6f6f6;font-family:Arial,sans-serif;font-size:14px;line-height:20px;text-align:center;margin-top:50px;margin-bottom:50px">
                                                                <em><a href="{verification_url}" style="font-size:20px;width:100%;padding:10px;background-color:#ffcc00;color:white;text-decoration: none;border-radius: 5px;" type="submit"><strong>Verify Account</span></strong></a>
                                                              </em></div>

                                                              <div style="color:#f6f6f6;font-family:Arial,sans-serif;font-size:14px;line-height:20px;text-align:center"><em>If you have any questions, please feel free to reply to this email.
                                                              </em></div>
                                                              <div style="color:#f6f6f6;font-family:Arial,sans-serif;font-size: 17px;
                                                              line-height: 26px;
                                                              text-align: left;
                                                              margin-top: 50px;">

                                                                Regards, <br />
                                                                Saita Logistics
                                                              </div>
                                                              <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%"><tbody><tr><td height="30" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%">&nbsp;</td></tr></tbody></table>
  
                                                          </td>
                                                          <td style="font-size:0pt;line-height:0pt;text-align:left" width="30"></td>
                                                      </tr>
                                                  </tbody></table>
                                              </td>
                                          </tr>
                                      </tbody></table>
                                  </td>
                                  <td height="32" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%">&nbsp;</td>
                              </tr>
                          </tbody></table>


  
                         
                      </td>
                  </tr>
                  
                  </tr>
              </tbody></table>
          </td>
          <td style="font-size:0pt;line-height:0pt;text-align:left" width="1"></td>
      </tr>
  </tbody></table>

  
  
  
  
  </td>
  </tr>
  </tbody></table><div class="yj6qo"></div><div class="adL">
  </div></div>';
  $message = str_replace('{user}', $user->name , $message);
  $message = str_replace('{email}', $user->email, $message);
  $message = str_replace('{verification_url}', url('user/verify', $user->token), $message);
                     try
                     {
                    $this->email->sendEmail($user->email, $subject, $message);

                        DB::commit();
                        $this->helper->one_time_message('success', __('We sent you an activation code. Check your email and click on the link to verify.'));
                        return redirect('/user-login');
                     }
                    catch (Exception $e)
                     {
                        DB::rollBack();
                        $this->helper->one_time_message('error', $e->getMessage());
                        return redirect('/user-login');
                     }
                }
                catch (Exception $e)
                {
                    DB::rollBack();
                    $this->helper->one_time_message('error', $e->getMessage());
                    return redirect('/user-login');
                   // $this->helper->one_time_message('success', __('Registration Successful!'));
                    //return redirect('/login');
                }

                
            }
        
    }
    public function forgotPassword(){
        return view('frontend.auth.forgetPassword');
    }
    public function forgetPasswordLink(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with(['status' => 'User not found']);
        } else {
            $status = Password::sendResetLink(
                $request->only('email')
            );
            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        }
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user.login');
    }

    /**
     * Show and manage Admin profile
     *
     * @return Admin profile page view
     */

}
