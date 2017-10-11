<?php

namespace App\Model\Lesson;

use Illuminate\Database\Eloquent\Model;

class LessonComment extends Model
{
    protected $table = "lesson_comment";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
