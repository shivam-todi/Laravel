<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginUsers extends Controller
{
  function login(Request $req)
  {
       $req->validate([
          "email"=>"email | required",
          "password"=>"min:6"
       ]);
       $user = User::where("email",$req->input('email'))->first();
       $userdata = array(
            'email'     => $req->input('email'),
            'password'  => $req->input('password')
        );
        if (\Auth::attempt($userdata))
        {
          $req->session()->put('user',$user->name);
          $req->session()->flash('data',"Welcome {$user->name}");
          return redirect('/');
        }
        else {
          dd("Wrong Password, Please try again");
        }
       // if (Hash::check($req->input('password'),$user->password))
       // {
       //     $req->session()->put('user',$user->name);
       //     $req->session()->flash('data',"Welcome {$req->input('email')}");
       //     return redirect('/');
       // }
      // print_r($req->input());
  }
}
