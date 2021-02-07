<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends Model
{
    use SoftDeletes;
    protected $fillable = ['blog_content','user_id'];
    function user()
    {
      return $this->belongsTo('App\User','user_id','id');
    }
    function comment()
    {
      return $this->hasMany('App\Comment','blog_id','id');
    }
    function like()
    {
      return $this->hasMany('App\Like','entity_id','id')->where('entity_type', 1);
    }
    function image()
    {
      return $this->hasMany('App\Image','entity_id','id')->where('entity_type', 1);
    }
}
