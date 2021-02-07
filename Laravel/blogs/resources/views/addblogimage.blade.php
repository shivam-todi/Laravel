@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Image</title>
  </head>
  <body>
    <div>
      <ul>
        @foreach($errors->all() as $e)
          <li>{{$e}}</li>
        @endforeach
      </ul>
    </div>
    <form action="submitimage" method="POST" enctype="multipart/form-data">
      @csrf
       <input type="hidden" placeholder="User ID" name="user_id" value={{\Auth::user()->id}} > <br><br>
       <input type="hidden" placeholder="Entity ID" name="entity_id" value={{$entity_id}} > <br><br>
       <input type="hidden" placeholder="Entity Type" name="entity_type" value=1 > <br><br>
       <input type="file" id="img" name="img" > <br><br>
       <button type="submit" name="button">Upload Image</button>
    </form>
  </body>
</html>
@endsection
