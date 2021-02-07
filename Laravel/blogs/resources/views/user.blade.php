@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
  </head>
  <body>
    <div>
      <ul>
        @foreach($errors->all() as $e)
          <li>{{$e}}</li>
        @endforeach
      </ul>
    </div>
    <form action="submit" method="POST">
      @csrf
       <input type="text" placeholder="user" name="user" > <br><br>
       <input type="text" placeholder="email" name="email" > <br><br>
       <input type="password" placeholder="password" name="password" > <br><br>
       <input type="password" placeholder="confirm password" name="password_confirmation" > <br><br>
       <button type="submit" name="button">Register</button>
    </form>
  </body>
</html>
@endsection
