<?php

namespace App\model\Issue;

use Illuminate\Database\Eloquent\Model;

class issue extends Model
{
    protected $table = "issue";
    protected $primaryKey = "ID";
    public $timestamps = false;

}
