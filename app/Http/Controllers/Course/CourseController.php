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
        return "Abort Content";
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