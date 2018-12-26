<?php

namespace App\Model\Announcement;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = "announcement";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
