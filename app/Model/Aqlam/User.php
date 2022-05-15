<?php

namespace App\Model\Aqlam;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Model
{
    protected $casts = [
        'id' => 'string',
    ];

    public function posts ()
    {
        return $this->hasMany('App\Model\Aqlam\Post');
    }

    public function getPictureAttribute($value)
    {
        if (!$value)
            return  url(asset('assets/images/alkafeel-author.jpeg'));
        elseif(Str::contains($value, 'images'))
            return $this->attributes['picture'] = "https://alkafeelblog.turathalanbiaa.com/".Storage::url($value);
        else
            return $this->attributes['picture'] = url(Storage::url($value));
    }
}
