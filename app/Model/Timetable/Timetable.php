<?php

namespace App\Model\Timetable;

use App\Model\Student\Level;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timetable extends Model
{
    protected $table = "lesson_timetable";
    protected $primaryKey = "ID";
    public $timestamps = false;

    public function Lesson()
    {
        return $this->hasOne('App/Model/Lesson/Lesson', 'Lesson_ID', 'ID');
    }







    public static function getTimetable($level, $group)
    {
        return DB::table("lesson_timetable")
            ->where('Level', '=', $level)
            ->where('Group', '=', $group)
            ->get();
    }

    public static function getTimetableForDate($level, $group, $date)
    {
        return DB::select("SELECT * FROM `lesson`, `lesson_timetable` 
                            WHERE `lesson`.`ID` = `lesson_timetable`.`Lesson_ID` 
                              AND `lesson_timetable`.`Level` = '$level' 
                              AND `lesson_timetable`.`Group` = '$group'
                              AND `lesson_timetable`.`Date` = '$date'");
    }

    public static function getTimetableMap()
    {
        return DB::select("SELECT `Level`, `Group` FROM lesson_timetable GROUP BY `Level`, `Group`");
    }

    public static function getTimetableForBeginner()
    {
        $success = DB::table("lesson_timetable")
            ->where('Level', '=', Level::BEGINNER)
            ->get();

        return $success;
    }

    public static function getTimetableForFirstLevelIntro()
    {
        $success = DB::table("lesson_timetable")
            ->where('Level', '=', Level::FIRST_LEVEL_INTRO)
            ->get();

        return $success;
    }

    public static function getTimetableForSecondLevelIntro()
    {
        $success = DB::table("lesson_timetable")
            ->where('Level', '=', Level::SECOND_LEVEL_INTRO)
            ->get();

        return $success;
    }

    public static function getTimetableForThirdLevelIntro()
    {
        $success = DB::table("lesson_timetable")
            ->where('Level', '=', Level::THIRD_LEVEL_INTRO)
            ->get();

        return $success;
    }


}
