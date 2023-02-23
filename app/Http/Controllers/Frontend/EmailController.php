<?php
/**
 * Email Controller
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\{Config,
    Mail,
    DB
};
use PHPMailer\PHPMailer\PHPMailer;

class EmailController extends Controller
{

    public function sendEmail($to, $subject, $message)
    {
        //$to = $to."<".$to.">";
        $mail = new \App\libraries\MailService();
        $data = [];
        $data = array(
            'to'      => array($to),
            'subject' => $subject,
            'html' => $message,
        );        


        if ($_ENV['MAIL_MAILER'] == 'smtp')
        {
            $this->setupEmailConfig();
            $mail->CharSet  = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->ContentType= 'text/html';
            $data1 = $mail->send($data, 'emails.sendmail');
        }
        else
        {
            $emailInfo = '';
            $this->sendPhpEmail($to, $subject, $message, $emailInfo);
        }
    }

    public function sendEmailWithAttachment($to, $subject, $messageBody, $path, $attachedFile)
    {
        $mail     = new \App\libraries\MailService();
        $dataMail = [];

        $dataMail = array(
            'to'      => array($to),
            'subject' => $subject,
            'content' => $messageBody,
            'attach'  => url('public/' . $path . '/' . $attachedFile),
        );


        if (env['MAIL_MAILER'] == 'smtp')
        {
            $this->setupNewsletterEmailConfig();
            $mail->CharSet  = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->send($dataMail, 'emails.sendmail');
        }
        else
        {
            $emailInfo = '';
            $this->sendPhpEmail($to, $subject, $messageBody, $emailInfo, $path, $attachedFile);
        }
    }

    public function setupEmailConfig()
    {
        Config::set([
            'mail.driver'     => $_ENV['MAIL_MAILER'],
            'mail.host'       => $_ENV['MAIL_HOST'],
            'mail.port'       => $_ENV['MAIL_PORT'],
            'mail.from'       => ['address' => $_ENV['MAIL_FROM_ADDRESS'], 'name' => $_ENV['MAIL_FROM_NAME']],
            'mail.encryption' => $_ENV['MAIL_ENCRYPTION'],
            'mail.username'   => $_ENV['MAIL_USERNAME'],
            'mail.password'   => $_ENV['MAIL_PASSWORD'],
        ]);
    }

    public function sendPhpEmail($to, $subject, $message, $emailInfo, $path = null, $attachedFile = null)
    {
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);

        $admin = Admin::where(['status' => 'Active'])->first(['first_name', 'last_name', 'email']);
        if (!empty($admin))
        {
            $mail->From     = $admin->email;
            $mail->FromName = $admin->first_name . ' ' . $admin->last_name;
            $mail->AddAddress($to, isset($admin) ? $mail->FromName : 'N/A');
            $mail->Subject = $subject;
            $mail->Body    = $message;

            //extra - starts
            $mail->WordWrap = 50;
            $mail->IsHTML(true);
            $mail->CharSet  = 'UTF-8';
            $mail->Encoding = 'base64';
            //extra - ends

            if (!empty($attachedFile))
            {
                $mail->AddAttachment(public_path('/' . $path . '/' . $attachedFile, 'base64'));
            }
            $mail->Send();
        }
    }

   
    
}
