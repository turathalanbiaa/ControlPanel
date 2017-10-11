<?php

namespace App\Model\Main;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admin";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
