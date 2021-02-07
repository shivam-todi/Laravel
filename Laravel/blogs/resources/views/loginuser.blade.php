@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <div>
      <ul>
        @foreach($errors->all() as $e)
          <li>{{$e}}</li>
        @endforeach
      </ul>
    </div>
    <form action="submituser" method="POST">
      @csrf
       <input type="text" placeholder="Email" name="email" > <br><br>
       <input type="password" placeholder="password" name="password" > <br><br>
       <button type="submit" name="button">Login</button>
    </form>
  </body>
</html>
@endsection
