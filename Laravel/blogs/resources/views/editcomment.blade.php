@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Comment</title>
  </head>
  <body>
    <div>
      <ul>
        @foreach($errors->all() as $e)
          <li>{{$e}}</li>
        @endforeach
      </ul>
    </div>
    <form action="submitedit" method="POST">
      @csrf
       <input type="hidden" placeholder="ID" name="id" value={{$id}} > <br><br>
       <input type="text" placeholder="Comment Content" name="comment_content" value={{$comment_content}} > <br><br>
       <button type="submit" name="button">Update Comment</button>
    </form>
  </body>
</html>
@endsection
