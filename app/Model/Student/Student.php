<?php

namespace App\Model\Student;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    protected $table = "student";
    protected $primaryKey = "ID";
    public $timestamps = false;


    public static function student($page_number, $page_size)
    {
        $offset = $page_size * ($page_number - 1);

        return DB::table("student")
            ->orderBy("ID","ASC")
            ->offset($offset)
            ->limit($page_size)
            ->get();
    }

    public function Paper()
    {
        return $this->hasMany('App\Model\Student\StudentPaper', 'Student_ID', 'ID');
    }
}
