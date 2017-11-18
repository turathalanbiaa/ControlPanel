<?php

namespace App\Http\Controllers\Timetable;

use App\Model\Course\Course;
use App\Model\Main\Authorization;
use App\Model\Main\Login;
use App\Model\Main\Map;
use App\model\Timetable\Timetable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class TimetableController extends Controller
{

    public function show()
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["TimeTable"]))
            return view("message.warning_message");

        $timetableMap = Timetable::getTimetableMap();

        return view("timetable.timetable_show")->with(["timetableMap" => $timetableMap]);
    }

    public function timeTable()
    {
        $state = 1;
        $level = Input::get("level");
        $group = Input::get("group");

        $today = date("Y-m-d");
        $d = strtotime($today);
        $keyForDay = date("D", $d);
        $dayForToday = $this->convertDayToArabic($keyForDay);
        $timetableForToday = Timetable::getTimeTableForDate($level, $group, $today);

        $d=strtotime("tomorrow");
        $tomorrow  = date("Y-m-d", $d);
        $keyForDay = date("D", $d);
        $dayForTomorrow = $this->convertDayToArabic($keyForDay);
        $timetableForTomorrow = Timetable::getTimeTableForDate($level, $group, $tomorrow);

        $d=strtotime("yesterday");
        $yesterday  = date("Y-m-d", $d);
        $keyForDay = date("D", $d);
        $dayForYesterday = $this->convertDayToArabic($keyForDay);
        $timetableForYesterday = Timetable::getTimeTableForDate($level, $group, $yesterday);


        return view("timetable.timetable")->with([
            "state" => $state,
            "level" => $level,
            "group" => $group,
            "timetableForToday" => [
                "Date" => $today,
                "Day" => $dayForToday,
                "Timetable" => $timetableForToday
            ],
            "timetableForTomorrow" => [
                "Date" => $tomorrow,
                "Day" => $dayForTomorrow,
                "Timetable" => $timetableForTomorrow
            ],
            "timetableForYesterday" => [
                "Date" => $yesterday,
                "Day" => $dayForYesterday,
                "Timetable" => $timetableForYesterday
            ]
        ]);
    }

    public function search(Request $request)
    {
        $state = 2;
        $level = Input::get('level');
        $group = Input::get('group');
        $date = Input::get("date");

        $this->validate($request, [
            'date' => 'required'
        ], [
            'date.required' => 'لا يوجد تاريخ مختار.'
        ]);

        $d = strtotime($date);
        $keyForDay = date("D", $d);
        $day = $this->convertDayToArabic($keyForDay);
        $timetable = Timetable::getTimeTableForDate($level, $group, $date);

        return view("timetable.timetable")->with([
            "state" => $state,
            "level" => $level,
            "group" => $group,
            "date" => $date,
            "day" => $day,
            "timetable" => $timetable
        ]);
    }

    public function timetableForEachLevels()
    {
        return view("timetable.timetable_for_levels");
    }

    public function addLessonToTimetable($level, $group)
    {
        $courses = Course::where("Level", "=", $level)->get();

        return view("timetable.add_lesson_to_timetable")->with([
            "level" => $level,
            "group" => $group,
            "courses" => $courses
        ]);
    }

    public function addLessonValidation()
    {
        $level = Input::get("level");
        $group = Input::get("group");
        $count = Input::get("count");
        $date = Input::get("date");

        $lessons_ID = [];

        for ($i = 1; $i <= $count; $i++)
        {
            $item = Input::get("course-".$i);

            if(!is_null($item))
            array_push($lessons_ID, $item);
        }

        if(empty($lessons_ID))
        {
            return redirect("/timetable/add-lesson/$level/$group")->with("AddLessonMessage", "يرجى اختيار الدروس الي تريد اضافتها الى الجدول الدراسي.");
        }

        foreach ($lessons_ID as $lesson_ID)
        {
            $timetable = new TimeTable;

            $timetable->Lesson_ID = $lesson_ID;
            $timetable->Date = $date;
            $timetable->Level = $level;
            $timetable->Group = $group;

            $timetable->save();
        }

        return redirect("/timetable/add-lesson/$level/$group")->with("AddLessonMessage", "تمت عملية اضافة الدروس الى الجدول الدراسي بنجاح.");
    }

    public function convertDayToArabic($keyForDay)
    {
        switch ($keyForDay)
        {
            case "Sat" : return "السبت";   break;
            case "Sun" : return "الاحد";    break;
            case "Mon" : return "الاثنين";  break;
            case "Tue" : return "الثلاثاء"; break;
            case "Wed" : return "الاربعاء"; break;
            case "Thu" : return "الخميس";  break;
            case "Fri" : return "الجمعه";  break;
        }

        return "";
    }
}