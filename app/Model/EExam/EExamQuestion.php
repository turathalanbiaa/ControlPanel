<?php

namespace App\Model\EExam;

use Illuminate\Database\Eloquent\Model;

class EExamQuestion extends Model
{
    protected $table = "e_exam_question";
    protected $primaryKey = "ID";
    public $timestamps = false;

    public function options()
    {
        return $this->hasMany('App\Model\EExam\EExamOption' , 'Question_ID' , 'ID');
    }
}
