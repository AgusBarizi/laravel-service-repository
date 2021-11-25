<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $mail_category;
    public $recipient_email;
    public $data;

    public function __construct($mail_category, $recipient_email, $data)
    {
        $this->mail_category = $mail_category;
        $this->recipient_email = $recipient_email;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            switch($this->mail_category){

                case 'resetPassword': 
                    //$data [reset_link]
                    logger('sending mail to '.$this->recipient_email);
                    \Mail::to($this->recipient_email)->send(new \App\Mail\ResetPasswordMail($this->data));
                    break;

                default:
                    logger('Mail category undefined');
                    break;
            }
        }catch(Exception $ex){
            logger('Failed when sending mail');
        }
        
    }
}
