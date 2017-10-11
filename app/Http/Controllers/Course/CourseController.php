<?php

namespace App\Http\Controllers\Course;

use App\Model\Course\Course;
use App\Model\Course\CourseEnroll;
use App\Model\Course\CourseReview;
use App\Model\Course\CourseType;
use App\Model\Lecturer\Lecturer;
use App\Model\Lesson\Lesson;
use App\Model\Main\Authorization;
use App\Model\Main\Login;
use App\Model\Main\Map;
use App\Model\Student\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;



class CourseController extends Controller
{

    public function showAll()
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["CoursesAndLessonsAndEExam"]))
            return view("message.warning_message");

        $courses = Course::all();
        return view("course.course")->with("courses", $courses);
    }

    public function search()
    {
        $query = Input::get("query");

        $courses = Course::where("name", 'LIKE', '%'.$query.'%')->get();
        return view("course.course")->with("courses", $courses);
    }

    public function create()
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["CoursesAndLessonsAndEExam"]))
            return view("message.warning_message");

        $lecturer = Lecturer::all();

        return view("course.course_create")->with(["lecturer" => $lecturer]);
    }

    public function createValidation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'lecturerID' => 'required|numeric',
            'type' => 'required|numeric',
            'level' => 'required|numeric',
            'detail' => 'required',
        ], [
            'name.required' => 'اسم الدورة فارغ.',
            'name.max' => 'اسم الدورة يجب ان لايتعدى 200 حرف.',
            'lecturerID.required' => 'يجب اختيار استاذ.',
            'lecturerID.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'type.required' => 'يجب اختيار نوع الدورة.',
            'type.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'level.required' => 'يرجى اختيار المرحلة.',
            'level.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'detail.required' => 'يجب ملئ بعض المعلومات عن الدورة.',
        ]);

        $course = new Course;

        $course->Name = Input::get("name");
        $course->Lecturer_ID = Input::get("lecturerID");
        $course->Type = Input::get("type");

        if (Input::get("type") == CourseType::GENERAL_COURSE)
            $course->Level = 10;
        elseif (Input::get("type") == CourseType::STUDY_COURSE)
            $course->Level = Input::get("level");

        $course->Detail = Input::get("detail");

        $success = $course->save();

        if (!$success)
            return redirect('/course/create')->with("CreateMessage", "لم تتم أضافة الدورة أعد المحاولة مرة أخرى");

        return redirect('/course/create')->with("CreateMessage", "تمت أضافة الدورة بنجاح");
    }

    public function showCoursesGroupByLevel()
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["CoursesAndLessonsAndEExam"]))
            return view("message.warning_message");

        $totalCountCourses = DB::table('course')
            ->select('Type', DB::raw('count(*) as Total'))
            ->groupBy('Type')
            ->get();

        $totalCountGeneralCourses = 0;
        $totalCountStudyCourses = 0;

        foreach ($totalCountCourses as $course)
        {
            switch ($course->Type)
            {
                case CourseType::GENERAL_COURSE:
                    $totalCountGeneralCourses = $course->Total;
                    break;

                case CourseType::STUDY_COURSE:
                    $totalCountStudyCourses = $course->Total;
                    break;
            }
        }

        $totalCountCourses = array(
            "totalCountGeneralCourses" => $totalCountGeneralCourses,
            "totalCountStudyCourses" => $totalCountStudyCourses
        );


        /*
         * get count course for each level where CourseType = StudyCourses
         * */

        $studyCourses = DB::table('course')
            ->select('Level', DB::raw('count(*) as Total'))
            ->where('Type','=', CourseType::STUDY_COURSE)
            ->groupBy('Level')
            ->get();

        $beginnerCount = 0;
        $firstLevelIntroCount = 0;
        $secondLevelIntroCount = 0;
        $thirdLevelIntroCount = 0;
        $firstLevelUpCount = 0;
        $secondLevelUpCount = 0;
        $thirdLevelUpCount = 0;


        foreach ($studyCourses as $studyCourse)
        {
            switch ($studyCourse->Level)
            {
                case Level::BEGINNER: $beginnerCount = $studyCourse->Total; break;

                case Level::FIRST_LEVEL_INTRO: $firstLevelIntroCount = $studyCourse->Total; break;

                case Level::SECOND_LEVEL_INTRO: $secondLevelIntroCount = $studyCourse->Total; break;

                case Level::THIRD_LEVEL_INTRO: $thirdLevelIntroCount = $studyCourse->Total; break;

                case Level::FIRST_LEVEL_UP: $firstLevelUpCount = $studyCourse->Total; break;

                case Level::SECOND_LEVEL_UP: $secondLevelUpCount = $studyCourse->Total; break;

                case Level::THIRD_LEVEL_UP: $thirdLevelUpCount = $studyCourse->Total; break;
            }
        }

        $studyCoursesWithKey = array(
            "beginner" => $beginnerCount,
            "firstLevelIntro" => $firstLevelIntroCount,
            "secondLevelIntro" => $secondLevelIntroCount,
            "thirdLevelIntro" => $thirdLevelIntroCount,
            "firstLevelUp" => $firstLevelUpCount,
            "secondLevelUp" => $secondLevelUpCount,
            "thirdLevelUp" => $thirdLevelUpCount
        );

        $generalCoursesWithKey = array(
            "general" => $totalCountGeneralCourses
        );


        return view("course.course_groups")->with(['studyCourses' =>  $studyCoursesWithKey,'generalCourses' =>  $generalCoursesWithKey, 'totalCountCourses' =>  $totalCountCourses]);
    }

    public function info($id)
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["CoursesAndLessonsAndEExam"]))
            return view("message.warning_message");

        $course = Course::find($id);
        $lecturers = Lecturer::all();
        $lessonsCount = Lesson::where('Course_ID','=',$id)->count();
        $rating = CourseReview::where('Course_ID','=',$id)->get()->avg('Rating');
        $courseEnrollCount = CourseEnroll::where('Course_ID','=',$id)->count();

        return view("course.course_info")->with([
            "course" => $course,
            "lecturers" => $lecturers,
            "lessonsCount" => $lessonsCount,
            "rating" => $rating,
            "courseEnrollCount" => $courseEnrollCount
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'numeric',
            'name' => 'required',
            'lecturerID' => 'required|numeric',
            'type' => 'required|numeric',
            'level' => 'required|numeric',
            'detail' => 'required',
        ], [
            'id.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'name.required' => 'اسم الدورة فارغ.',
            'lecturerID.required' => 'يجب اختيار استاذ.',
            'lecturerID.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'type.required' => 'يجب اختيار نوع الدورة.',
            'type.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'level.required' => 'يرجى اختيار المرحلة.',
            'level.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'detail.required' => 'يجب ملئ بعض المعلومات عن الدورة.',
        ]);

        $course = Course::find(Input::get("id"));

        if (!$course)
            return redirect("/course/info-$course->ID")->with('UpdateMessage', 'لم يتم تعديل البيانات بنجاح يرجى اعادة العملية من جديد');

        $course->Name = Input::get("name");
        $course->Lecturer_ID = Input::get("lecturerID");
        $course->Type = Input::get("type");

        if (Input::get("type") == CourseType::GENERAL_COURSE)
            $course->Level = 10;
        elseif (Input::get("type") == CourseType::STUDY_COURSE)
            $course->Level = Input::get("level");

        $course->Detail = Input::get("detail");

        $course->save();

        return redirect("/course/info-$course->ID")->with("UpdateMessage", "تم تعديل معلومات الدورة بنجاح");
    }

    public function delete()
    {
        $course = Course::find(Input::get('courseID'));
        $success = $course->delete();

        if (!$success)
            return redirect('/courses/show')->with("DeleteMessage", "لم يتم حذف الدورة بنجاح , يرجى اعادة المحاولة.");

        return redirect('/courses/show')->with("DeleteMessage", "تمت حذف الدورة بنجاح.");
    }

}