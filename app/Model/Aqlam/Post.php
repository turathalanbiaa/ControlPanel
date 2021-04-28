<?php

namespace App\Model\Aqlam;

use Illuminate\Database\Eloquent\Model;

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
}
