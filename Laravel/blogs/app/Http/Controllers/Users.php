<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class Users extends Controller
{
    function submit(Request $req)
    {
        $req->validate([
          "user"=>"required",
          "email"=>"min:5 | email",
          "password"=>"min:6 | confirmed"
        ]);
        User::create([
            'name' => $req->input('user'),
            'email' => $req->input('email'),
            'password' => Hash::make($req->input('password')),
        ]);
        $userdata = array(
             'email'     => $req->input('email'),
             'password'  => $req->input('password')
         );
        \Auth::attempt($userdata);
        $req->session()->flash('data',"Welcome {$req->input('user')}");
        return redirect('/email/verify');
        // print_r($req->input());
    }
    function logout(Request $req)
    {
        \Auth::logout();
        $req->session()->flush();
        $req->session()->flash('data',"Successfully logged out");
        return redirect('/');
    }
}
