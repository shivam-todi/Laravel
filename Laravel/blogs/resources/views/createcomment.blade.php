@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Comment</title>
  </head>
  <body>
    <div>
      <ul>
        @foreach($errors->all() as $e)
          <li>{{$e}}</li>
        @endforeach
      </ul>
    </div>
    <form action="submitcomment" method="POST">
      @csrf
       <input type="hidden" placeholder="User" name="user" value={{\Auth::user()->name}} > <br><br>
       <input type="hidden" placeholder="Blog ID" name="blog_id" value={{$blog_id}} > <br><br>
       <input type="text" placeholder="Comment" name="comment_content" > <br><br>
       <button type="submit" name="button">Add Comment</button>
    </form>
  </body>
</html>
@endsection
