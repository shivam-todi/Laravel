<?php

namespace App\Console\Commands;

use App\User;
use App\Blog;
use App\Comment;
use App\Like;
use App\Image;
use Illuminate\Console\Command;

class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will mail all users everyday';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $users = User::all();
      foreach ($users as $user)
      {
        $to_name = $user->name;
        $to_email = $user->email;
        $data = array('name' => $user->name, 'body' => "Welcome to CoalShastra!!" );
        \Mail::send('mail', $data, function($message) use ($to_name, $to_email){
            $message->to($to_email)
                ->subject('Welcome to CoalShastra');
        });
      }
      echo "Job completed";
    }
}
