@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create Blog</title>
  </head>
  <body>
    <div>
      <ul>
        @foreach($errors->all() as $e)
          <li>{{$e}}</li>
        @endforeach
      </ul>
    </div>
    <form action="blogsubmit" method="POST">
      @csrf
       <input type="hidden" placeholder="user" name="user" value={{\Auth::user()->name}} > <br><br>
       <textarea id="blog_content" placeholder="Blog Content" name="blog_content" rows="20" cols="200" >
         </textarea> <br><br>
       <button type="submit" name="button">Create Blog</button>
    </form>
  </body>
</html>
@endsection
