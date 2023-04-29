<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $emailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData=$emailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fromEmail=env("MAIL_FROM_ADDRESS");
        $fromName=env("EMAIL_FROM_NAME");
        $emailSubject=env("EMAIL_DEFULT_SUBJECT");
        $emailTemplate=env("EMAIL_DEFULT_EMAIL_TEMPLATE");
        $emailContent=array();
        if(!empty($this->emailData)){
            /**
             * Check and set from data
             */
            if(!empty(checkKeyExists("from",$this->emailData))){
                $fromData=checkKeyExists("from",$this->emailData);
                if(!empty(checkKeyExists("email",$fromData['email']))){
                    $fromEmail=checkKeyExists("email",$fromData['email']);
                }
                if(!empty(checkKeyExists("name",$fromData['name']))){
                    $fromName=checkKeyExists("name",$fromData['name']);
                }
            }
            /**
             * Check and set subject data
             */
            if(!empty(checkKeyExists("subject",$this->emailData))){
                $emailSubject=checkKeyExists("subject",$this->emailData);
            }
            /**
             * Check and set email template view
             */
            if(!empty(checkKeyExists("email_template",$this->emailData))){
                $emailTemplate=checkKeyExists("email_template",$this->emailData);
            }
            
            /**
             * Check and set email template view
             */
            if(!empty(checkKeyExists("email_content",$this->emailData))){
                $emailContent=checkKeyExists("email_content",$this->emailData);
            }
        }
        /*mydd($emailContent);*/
        return $this->from($fromEmail,$fromName)->subject($emailSubject)
            ->view($emailTemplate,["emailContent"=>$emailContent]);
        /*return $this->view('view.name');*/
    }
}
