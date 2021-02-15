<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class WelcomeMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $to_name =  "Shivam CoalShastra!!";
      $to_email = "shivamtodi@gmail.com";
      $user_name = "Shivam CoalShastra!";
      $data = array('name' => $user_name, 'body' => "Welcome to CoalShastra!!" );
      \Mail::send('mail', $data, function($message) use ($to_name, $to_email){
          $message->to($to_email)
              ->subject('Welcome to CoalShastra');
      });
    }
}
