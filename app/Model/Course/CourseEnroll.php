<?php

namespace App\Model\Course;

use Illuminate\Database\Eloquent\Model;

class CourseEnroll extends Model
{
    protected $table = "course_enroll";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
