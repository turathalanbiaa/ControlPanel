<?php

namespace App\Model\Lesson;

use Illuminate\Database\Eloquent\Model;

class WatchedLesson extends Model
{
    protected $table = "watched_lesson";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
