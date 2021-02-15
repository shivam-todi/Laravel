<?php

namespace App\Listener;

use App\Event\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $to_name =  \Auth::user()->name;
        $to_email = \Auth::user()->email;
        $user_name = \Auth::user()->name;
        $data = array('name' => $user_name, 'body' => "Welcome to CoalShastra!!" );
        \Mail::send('mail', $data, function($message) use ($to_name, $to_email){
            $message->to($to_email)
                ->subject('Welcome to CoalShastra');
        });
        echo $event->email;
        return redirect('/home');
    }
}
