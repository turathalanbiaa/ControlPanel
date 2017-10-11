<?php

namespace App\Model\Lecturer;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $table = "lecturer";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
