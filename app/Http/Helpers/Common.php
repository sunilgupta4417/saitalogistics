<?php
namespace App\Http\Helpers;

use App\Http\Controllers\Frontend\EmailController;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Exception;
use Auth,DB;

class Common
{
    protected $email;

    public function __construct()
    {
        $this->email                   = new EmailController();
    }

    public static function one_time_message($class, $message)
    {
        if ($class == 'error')
        {
            $class = 'danger';
        }
        Session::flash('alert-class', 'alert-' . $class);
        Session::flash('message', $message);
    }

}
