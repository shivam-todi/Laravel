@extends('layouts.app')
@section('content')
  <h1>Blogs</h1>
  @foreach ($data as $item)
            <li>
              <span><h5>{{ $item->blog_content}}</h5></span>
              @if(App\Image::where("entity_id",$item->id)->where("entity_type",1)->first()!=null)
                  <img src="{{$item->image[0]->file_path}}" height="150px" width="150px">
                <br><br>
              @endif
              @if(App\Like::where("user_id",\Auth::user()->id)->where("entity_id",$item->id)->where("entity_type",1)->first()==null || App\Like::where("user_id",\Auth::user()->id)->where("entity_id",$item->id)->where("entity_type",1)->first()->likes_count==0)
                <span> <a href="likeblog/{{$item->id}}">Like</a></span>
              @else
                <span> <a href="likeblog/{{$item->id}}">Unlike</a></span>
              @endif
              @if($item->user_id==\Auth::user()->id)
                <span> <a href="editblog/{{$item->id}}">Edit</a></span>
                <span> <a href="addblogimage/{{$item->id}}">Add Image</a></span>
                <span> <a href="deleteblog/{{$item->id}}">Delete</a></span>
              @endif
              <br>
              <span> <b> Created by {{ $item->user->name}} </b></span>
              @if($item->comment->isNotEmpty())
                  @foreach ($item->comment as $com)
                      <br>
                      <span><em>{{$com->comment_content}}</em></span>
                  @endforeach
              @endif
              <br>
              <span><a href="createcomment/{{$item->id}}">Add Comment</a></span>
              <span><a href="deletecomment/{{$item->id}}">Edit Comment</a></span>
              <span><a href="deletecomment/{{$item->id}}">Delete Comment</a></span>
              <br><br>
            </li>
  @endforeach
  <div>{{$data->links()}}</div>
@endsection
