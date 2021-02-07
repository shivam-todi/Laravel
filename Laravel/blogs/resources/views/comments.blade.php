@extends('layouts.app')
@section('content')
  <h1>Comments</h1>
  @foreach ($data as $item)
    @if($item->blog_id==$blog_id)
      <br>
      <span><em><h5>{{$item->comment_content}}</h5></em></span>
      @if(App\Image::where("entity_id",$item->id)->where("entity_type",2)->first()!=null)
          <img src="{{$item->image[0]->file_path}}" height="150px" width="150px">
        <br><br>
      @endif
      <span><strong>Created by {{$item->user->name}}</strong></span>
      <br><br>
      @if(App\Like::where("user_id",\Auth::user()->id)->where("entity_id",$item->id)->where("entity_type",2)->first()==null || App\Like::where("user_id",\Auth::user()->id)->where("entity_id",$item->id)->where("entity_type",2)->first()->likes_count==0)
        <span><a href="likecomment/{{$item->id}}">Like</a></span>
      @else
        <span><a href="likecomment/{{$item->id}}">Unlike</a></span>
      @endif
      @if($item->user_id==\Auth::user()->id)
        <span><a href="edit/{{$item->id}}">Edit</a></span>
        <span><a href="addcommentimage/{{$item->id}}">Add Image</a></span>
        <span><a href="delete/{{$item->id}}">Delete</a></span>
      @endif
      <br><br>
    @endif
  @endforeach
@endsection
