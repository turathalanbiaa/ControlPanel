<?php

namespace App\Model\Library;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $connection = 'mysql3';
    public $timestamps = false;
}
