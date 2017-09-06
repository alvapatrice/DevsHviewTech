<?php
/**
 * Created by PhpStorm.
 * User: Satish
 * Date: 24-Aug-15
 * Time: 12:54 AM
 */

namespace App\Repos\Mailer;


class SubscriberMailer extends Mailer {

    public function welcome( $email )
    {
        $this->email = $email;
        $this->subject = 'Welcome to Devartisans';
        $this->view = 'emails.subscriber';
        $this->data = [];

        return $this->send();
    }
}