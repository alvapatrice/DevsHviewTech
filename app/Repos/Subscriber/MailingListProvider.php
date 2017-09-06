<?php 
namespace App\Repos\Subscriber;

use Mailchimp;
use App\Repos\Mailer\SubscriberMailer as Mailer;
class MailingListProvider {

    protected $mailchimp;
    protected $apikey;
    protected $listid;
    protected $mailer;

    public function __construct()
    {
        $this->listid = getenv('MAILCHIMP_LIST_ID');
        $this->apikey = getenv('MAILCHIMP_API_KEY');
        $this->mailchimp = new Mailchimp($this->apikey);
        $this->mailer = new Mailer;
    }

    public function subscribeToList($email)
    {
       try {
            $status = $this->mailchimp->lists->subscribe(
                $this->listid,
                compact('email'),
                null, // merge vars
                'html', // email type
                false, // requires double optin
                false, // update existing members
                true
            );

            return $this->sendWelcomeEmail($email);

        }
        catch(Exception $e)
        {
            return false;
            // if 214 then already subscribed
            //var_dump($e->getCode());
        }
    }

    public function unsubscribeFromList($email)
    {
        return $this->mailchimp->lists->unsubscribe(
            $this->listid,
            compact('email'),
            false, //delete permanently
            false, //send goodbye emails
            false //send unsubscribe notification email
        );
    }

    public function sendCampaign()
    {
        $html = "<h1>Hello from Devartisans.com</h1><p> Thank you for subscribing to devartisans</p>";
        $options = [
            'list_id'   => $this->listid,
            'subject' => 'Welcome to devartisans',
            'from_name' => 'Devartisans',
            'from_email' => 'satish@devartisans.com',
            'to_name' => 'Fitnesshack Subscriber'
        ];

        $content = [
            'html' => $html,
            'text' => strip_tags($html)
        ];

        $campaign = $this->mailchimp->campaigns->create('regular', $options, $content);
        $this->mailchimp->campaigns->send($campaign['id']);
    }

    public function sendWelcomeEmail($email)
    {
        return $this->mailer->welcome($email);
    }
}