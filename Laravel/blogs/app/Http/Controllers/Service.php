<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Blog;
use App\Comment;
use App\Like;
use App\Image;
use Illuminate\Support\Facades\Validator;
use Session;

class Service extends Controller
{
    public function Disp()
    {
        $data = User::all();
        return view('service',['data'=>$data]);
    }
    function createblog(Request $req)
    {

        $req->validate([
          "user"=>"required",
          "blog_content"=>"required",
        ]);
        $user = User::where("name",$req->input('user'))->first();
        // $blog = new Blog;
        // $blog->user_id = $user->id;
        // $blog->blog_content = $req->input('blog_content');
        // $blog->save();
        Blog::create([
            'user_id' => $user->id,
            'blog_content' => $req->input('blog_content')
        ]);
        $req->session()->flash('data',"Blog created");
        return redirect('/');
        // print_r($req->input());
    }
    function createcomment(Request $req)
    {
        $req->validate([
          "user"=>"required",
          "blog_id"=>"required",
          "comment_content"=>"required"
        ]);
        $user = User::where("name",$req->input('user'))->first();
        // $blog = Blog::where("id",$req->input('blog_id'))->first();
        $comment = new Comment;
        $comment->user_id = $user->id;
        $comment->comment_content = $req->input('comment_content');
        $comment->blog_id = $req->input('blog_id');
        $comment->save();
        // Blog::create([
        //     'user_id' => $user->id,
        //     'blog_content' => $req->input('blog_content')
        // ]);
        $req->session()->flash('data',"Comment created");
        return redirect('/');
        // print_r($req->input());
    }
    function displayblog()
    {
        $data = Blog::with('user','comment','image')->paginate(3);
        return view('blogs',['data'=>$data]);
    }
    function displaypersonalblog()
    {
        $data = Blog::with('user','comment','image')->where("user_id",\Auth::user()->id)->paginate(3);
        return view('blogs',['data'=>$data]);
    }
    function editblog(Request $req)
    {
      $req->validate([
        "blog_id"=>"required",
        "blog_content"=>"required",
      ]);
      // $blog = new Blog;
      // $blog->user_id = $user->id;
      // $blog->blog_content = $req->input('blog_content');
      // $blog->save();
      $blog = Blog::find("id",$req->input('blog_id'));
      $blog->blog_content=$req->input('blog_content');
      $blog->update();
      $req->session()->flash('data',"Blog updated");
      return redirect('/blogs');
    }
    function vieweditblog(Request $req, $blog_id)
    {
        $blog = Blog::find($blog_id);
        return view('editblog',['blog_id'=>$blog_id,'blog_content'=>$blog->blog_content]);
    }
    function search(Request $req)
    {
        $blog = Blog::where('id',$req->input('query'))->first();
        return view('editblog',['blog_id'=>$blog->id,'blog_content'=>$blog->blog_content]);
    }
    function addimage(Request $req)
    {
      $req->validate([
        "entity_id"=>"required",
        "entity_type"=>"required",
        "user_id"=>"required",
        "img"=>"required"
      ]);
      // $blog = new Blog;
      // $blog->user_id = $user->id;
      // $blog->blog_content = $req->input('blog_content');
      // $blog->save();
      $image = new Image;
      $image->user_id = $req->input('user_id');
      $image->entity_id = $req->input('entity_id');
      $image->entity_type = $req->input('entity_type');
      $image->image_url = $req->file('img')->store('public');
      $image->save();
      return redirect('/blogs');
    }
    function viewaddimage(Request $req, $entity_id)
    {
        return view('addblogimage',['entity_id'=>$entity_id]);
    }
    function viewaddcomimage(Request $req, $entity_id)
    {
        return view('addcommentimage',['entity_id'=>$entity_id]);
    }
    function editcomment(Request $req)
    {
      $req->validate([
        "id"=>"required",
        "comment_content"=>"required",
      ]);
      // $blog = new Blog;
      // $blog->user_id = $user->id;
      // $blog->blog_content = $req->input('blog_content');
      // $blog->save();
      $comment = Comment::find($req->input('id'));
      $comment->comment_content=$req->input('comment_content');
      $comment->update();
      return redirect('/blogs');
    }
    function vieweditcomment(Request $req, $id)
    {
        $comment = Comment::find($id);
        return view('editcomment',['id'=>$id,'comment_content'=>$comment->comment_content]);
    }
    function viewcommentpage(Request $req, $blog_id)
    {
        return view('createcomment',['blog_id'=>$blog_id]);
    }
    function viewcomments($blog_id)
    {
        $data = Comment::with('blog','user')->get();
        return view('comments',['blog_id'=>$blog_id,'data'=>$data]);
    }
    function deletecomment($id)
    {
        Comment::destroy($id);
        return redirect('/blogs');
    }
    function deleteblog($id)
    {
        Blog::destroy($id);
        return redirect('/blogs');
    }
    function likeblog($id)
    {
        $check = Like::where("user_id",\Auth::user()->id)->where("entity_id",$id)->where("entity_type",1)->first();
        if($check!=null)
        {
          if($check->likes_count>0)
          {
            $check->likes_count=0;
          }
          else
          {
            $check->likes_count=1;
          }
          $check->update();
          return redirect('/blogs');
        }
        $like = new Like;
        $like->user_id = \Auth::user()->id;
        $like->likes_count = 1;
        $like->entity_type = 1;
        $like->entity_id = $id;
        $like->save();
        return redirect('/blogs');
    }
    function likecomment($id)
    {
        $check = Like::where("user_id",\Auth::user()->id)->where("entity_id",$id)->where("entity_type",2)->first();
        if($check!=null)
        {
          if($check->likes_count>0)
          {
            $check->likes_count=0;
          }
          else
          {
            $check->likes_count=1;
          }
          $check->update();
          return redirect('/blogs');
        }
        $like = new Like;
        $like->user_id = \Auth::user()->id;
        $like->likes_count = 1;
        $like->entity_type = 2;
        $like->entity_id = $id;
        $like->save();
        return redirect('/blogs');
    }
}
