<?php

namespace App\Http\Controllers\Timetable;

use App\Model\Course\Course;
use App\Model\EventLog\EventLog;
use App\Model\Main\Authorization;
use App\Model\Main\Login;
use App\Model\Main\Map;
use App\Model\Student\Level;
use App\Model\Timetable\Timetable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TimetableController extends Controller
{
    public function timetable()
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["TimeTable"]))
            return view("message.warning_message");

        return view("timetable.timetable");

    }

    public function search()
    {
        $level = Input::get("level");
        $group = Input::get("group");
        $fromDate = Input::get("fromDate");
        $toDate = Input::get("toDate");
        $results =  DB::select('select count(*) as CountOfLessons,`Date` from `lesson_timetable` where `Level` = ? AND `Group` = ? AND `Date` >= ? AND `Date` < ? GROUP BY `Date`', [$level, $group, $fromDate, $toDate]);
        return view("timetable.timetable")->with(["results"=>$results, "level"=>$level, "group"=>$group]);
    }

    public function preAddLessons()
    {
        return view("timetable.pre_add_lessons");
    }

    public function preUpdateLessons()
    {
        return view("timetable.pre_update_lessons");
    }

    public function operations()
    {
        $level = Input::get("level");
        $group = Input::get("group");
        $sendAction = Input::get("send");

        switch ($sendAction)
        {
            case "pre-add-lessons" :
                $courses = Course::where("level","=",Input::get("level"))->get();
                return view("timetable.add_lessons")->with(["level" => $level, "group" => $group, "courses" => $courses]);
                break;

            case "pre-update-lessons" :
                $date = Input::get("date");
                $courses = Course::where("level","=",Input::get("level"))->get();

                $lessonsInTimetable = DB::table('lesson')
                    ->rightJoin('lesson_timetable', 'lesson.ID', '=', 'lesson_timetable.Lesson_ID')
                    ->where("level",$level)
                    ->where("group",$group)
                    ->where("date",$date)
                    ->get();

                return view("timetable.update_lessons")->with(["level"=>$level, "group"=>$group, "date"=>$date, "courses"=>$courses, "lessonsInTimetable"=>$lessonsInTimetable]);
                break;

            default : return "";
        }
    }

    public function addLesson()
    {
        $level = Input::get("level");
        $group = Input::get("group");
        $count = Input::get("count");
        $date = Input::get("date");

        $lessonsID = [];

        for ($i = 1; $i <= $count; $i++)
        {
            $item = Input::get("course-".$i);

            if(!is_null($item))
                array_push($lessonsID, $item);
        }

        if(empty($lessonsID))
            return redirect("/timetable/operations?level=$level&group=$group&send=pre-add-lessons")->with("AddLessonMessage", "يرجى اختيار الدروس الي تريد اضافتها الى الجدول الدراسي لهذه المرحلة.");

        foreach ($lessonsID as $lessonID)
        {
            $timetable = new TimeTable;
            $timetable->Lesson_ID = $lessonID;
            $timetable->Date = $date;
            $timetable->Level = $level;
            $timetable->Group = $group;
            $timetable->save();
        }

        $description = Level::getLevelName($level) . " - " . $group;
        EventLog::addEvent(EventLog::TIMETABLE_EVENTS_LOG["ADD LESSONS TO TIMETABLE"], $description);
        return redirect("/timetable/operations?level=$level&group=$group&send=pre-add-lessons")->with("AddLessonMessage", "تمت عملية اضافة الدروس الى الجدول الدراسي بنجاح لهذه المرحلة.");
    }

    public function updateLesson()
    {
        $level = Input::get("level");
        $group = Input::get("group");
        $count = Input::get("count");
        $date = Input::get("date");

        $lessonsID = [];

        for ($i = 1; $i <= $count; $i++)
        {
            $item = Input::get("course-".$i);

            if(!is_null($item))
                array_push($lessonsID, $item);
        }

        $lessonsInTimetable = Timetable::where("level",$level)->where("group",$group)->where("Date",$date)->get();

        foreach ($lessonsInTimetable as $lessonInTimetable)
            $lessonInTimetable->delete();

        if(empty($lessonsID))
            return redirect("/timetable/operations?level=$level&group=$group&date=$date&send=pre-update-lessons")->with("UpdateLessonMessage", "يرجى اختيار الدروس الي تريد تعديلها في الجدول الدراسي لهذه المرحلة.");

        foreach ($lessonsID as $lessonID)
        {
            $timetable = new TimeTable;
            $timetable->Lesson_ID = $lessonID;
            $timetable->Date = $date;
            $timetable->Level = $level;
            $timetable->Group = $group;
            $timetable->save();
        }

        $description = Level::getLevelName($level) . " - " . $group;
        EventLog::addEvent(EventLog::TIMETABLE_EVENTS_LOG["UPDATE LESSONS ON TIMETABLE"], $description);
        return redirect("/timetable/operations?level=$level&group=$group&date=$date&send=pre-update-lessons")->with("UpdateLessonMessage", "تمت عملية اضافة الدروس الى الجدول الدراسي بنجاح لهذه المرحلة.");
    }

    public function timetableForEachLevels()
    {
        return view("timetable.timetable_for_levels");
    }
}
