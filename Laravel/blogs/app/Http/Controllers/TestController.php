<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event\UserCreated;
use App\Jobs\WelcomeMessage;

class TestController extends Controller
{
    public function Test2()
    {
      return view('welcome');
    }
    public function index()
    {
      event(new UserCreated("Email sent!"));
    }
    public function job()
    {
      WelcomeMessage::dispatch();
      echo "Jobs completed";
    }

}
