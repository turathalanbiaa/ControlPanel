<?php

namespace App\Model\Course;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "course";
    protected $primaryKey = "ID";
    public $timestamps = false;

    public function Lecturer()
    {
        return $this->hasOne('App\Model\Lecturer\Lecturer', 'ID', 'Lecturer_ID');
    }

    public function Lessons()
    {
        return $this->hasMany('App\Model\Lesson\Lesson', 'Course_ID', 'ID');
    }
}
