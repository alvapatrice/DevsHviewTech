<?php
namespace App\Repos\Subscriber;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Repos\Subscriber\MailingListProvider;
class SubscriptionHandler {

    protected $listener;

    public function __construct( $listener )
    {
        $this->listener = $listener;
    }

    public function saveNewSubscriber(array $data )
    {
        return User::create([
            'email' => $data['email'],
            'type' => 5
        ]);
    }

    protected function validate(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users'
        ]);
    }

    public function subscribe(Request $request)
    {

        if ($this->validate($request)->fails())
        {
            return $this->listener->subscription_failed('You have already subscribed to our mailing list');
        }

        $subscriberAdded = $this->saveNewSubscriber($request->all());

        if( $subscriberAdded )
        {
            //send Welcome Email to user
            $mailingListProvider = new MailingListProvider;
            $addedToProviderList = $mailingListProvider->subscribeToList($request->get('email'));
            if($addedToProviderList)
            {
                return $this->listener->subscription_succeed('Thank you for subscribing');
            }
        }


    }
}