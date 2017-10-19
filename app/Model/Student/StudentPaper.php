<?php

namespace App\Model\Student;

use Illuminate\Database\Eloquent\Model;

class StudentPaper extends Model
{
    protected $table = "student_paper";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
