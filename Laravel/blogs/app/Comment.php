<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
  use SoftDeletes;
  protected $fillable = ['comment_content','blog_id','user_id'];
  function blog()
  {
    return $this->belongsTo('App\Blog','blog_id','id');
  }
  function user()
  {
    return $this->belongsTo('App\User','user_id','id');
  }
  function like()
  {
    return $this->hasMany('App\Like','entity_id','id')->where('entity_type', 2);
  }
  function image()
  {
    return $this->hasMany('App\Image','entity_id','id')->where('entity_type', 2);
  }
}
