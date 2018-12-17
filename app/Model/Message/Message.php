<?php

namespace App\Model\Message;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "message";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
