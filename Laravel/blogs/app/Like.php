<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  protected $fillable = ['likes_count','entity_type','entity_id','user_id'];
  function user()
  {
    return $this->belongsTo('App\User','user_id','id');
  }
}
