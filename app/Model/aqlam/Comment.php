<?php

namespace App\Model\Aqlam;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $connection = 'mysql2';
    public  function user ()
    {
        return $this->belongsto('App\Model\Aqlam\User');
    }
}
