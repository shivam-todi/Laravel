@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Blog</title>
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
       <input type="hidden" placeholder="ID" name="blog_id" value={{$blog_id}} > <br><br>
       <textarea id="blog_content" placeholder="Blog Content" name="blog_content" rows="20" cols="200" >{{$blog_content}}
         </textarea>
         <br><br>
       <button type="submit" name="button">Update Blog</button>
    </form>
  </body>
</html>
@endsection
