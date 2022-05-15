<?php

namespace App\Model\Aqlam;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class post extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';


    public function rates ()
    {
        return $this->hasMany('App\Model\Aqlam\Rate');
    }

    public function comments ()
    {
        return $this->hasMany('App\Model\Aqlam\Comment');
    }

    public  function user ()
    {
        return $this->belongsTo('App\Model\Aqlam\User');
    }

    public function getImageAttribute($value)
    {
        if (!$value)
            return  url(asset('assets/images/alkafeel-article.jpeg'));
        elseif(Str::contains($value, 'images'))
            return $this->attributes['image'] = "https://alkafeelblog.turathalanbiaa.com/".Storage::url($value);
        else
            return $this->attributes['image'] = url(Storage::url($this->image));
    }
}
