<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $appends = [
        'file_path'
    ];

    public function getFilePathAttribute()
    {
        $imageUrl = $this->image_url;

        if(\Storage::exists($imageUrl))
        {
            return \Storage::url($imageUrl);
        }
    }
}
