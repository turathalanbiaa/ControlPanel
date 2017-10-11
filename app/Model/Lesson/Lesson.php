<?php

namespace App\Model\Lesson;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = "lesson";
    protected $primaryKey = "ID";
    public $timestamps = false;

    public function views()
    {
        return $this->hasMany('App\Model\Lesson\WatchedLesson', 'Lesson_ID', 'ID');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Lesson\LessonComment', 'Lesson_ID', 'ID');
    }

    public function Course()
    {
        return $this->hasOne('App\Model\Course\Course', 'ID', 'Course_ID');
    }

    public function Lecturer()
    {
        return $this->hasOne('App\Model\Lecturer\Lecturer', 'ID', 'Lecturer_ID');
    }

    public function EExamQuestion()
    {
        return $this->hasMany('App\Model\EExam\EExamQuestion', 'Lesson_ID', 'ID');
    }
}
