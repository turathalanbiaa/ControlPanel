<?php

namespace App\Model\Course;

use Illuminate\Database\Eloquent\Model;

class CourseReview extends Model
{
    protected $table = "course_review";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
