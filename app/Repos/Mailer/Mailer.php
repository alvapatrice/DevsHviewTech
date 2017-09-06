<?php
namespace App\Repos\Mailer;

use Illuminate\Support\Facades\Mail;
class Mailer {

    protected $email;
    protected $subject;
    protected $view;
    protected $data;

    public function send()
    {
        return Mail::send($this->view, $this->data, function($message) {
            $message->to($this->email)
                        ->subject($this->subject);
        });
    }

}