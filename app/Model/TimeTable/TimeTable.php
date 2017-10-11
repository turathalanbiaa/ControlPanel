<?php

namespace App\model\Timetable;

use App\Model\Student\Level;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TimeTable extends Model
{
    protected $table = "lesson_timetable";
    protected $primaryKey = "ID";
    public $timestamps = false;


    public static function getTimeTable($level, $group)
    {
        return DB::table("lesson_timetable")
            ->where('Level', '=', $level)
            ->where('Group', '=', $group)
            ->get();
    }

    public static function getTimeTableForDate($level, $group, $date)
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

    public static function getTimeTableForBeginner()
    {
        $success = DB::table("lesson_timetable")
            ->where('Level', '=', Level::BEGINNER)
            ->get();

        return $success;
    }

    public static function getTimeTableForFirstLevelIntro()
    {
        $success = DB::table("lesson_timetable")
            ->where('Level', '=', Level::FIRST_LEVEL_INTRO)
            ->get();

        return $success;
    }

    public static function getTimeTableForSecondLevelIntro()
    {
        $success = DB::table("lesson_timetable")
            ->where('Level', '=', Level::SECOND_LEVEL_INTRO)
            ->get();

        return $success;
    }

    public static function getTimeTableForThirdLevelIntro()
    {
        $success = DB::table("lesson_timetable")
            ->where('Level', '=', Level::THIRD_LEVEL_INTRO)
            ->get();

        return $success;
    }

    public function Lesson()
    {
        return $this->hasOne('App/Model/Lesson/Lesson', 'Lesson_ID', 'ID');
    }
}
