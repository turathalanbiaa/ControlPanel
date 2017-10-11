<?php

namespace App\Http\Controllers\Lesson;

use App\Http\Requests\Request;
use App\Model\Course\Course;
use App\Model\EExam\EExamQuestion;
use App\Model\Lecturer\Lecturer;
use App\Model\Lesson\Lesson;
use App\Model\Lesson\LessonComment;
use App\Model\Lesson\WatchedLesson;
use App\Model\Main\Authorization;
use App\Model\Main\Login;
use App\Model\Main\Map;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LessonController extends Controller
{
    public function showLessons($courseID)
    {
        if (!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["CoursesAndLessonsAndEExam"]))
            return view("message.warning_message");

        $course = Course::find($courseID);

        return view("lesson.lesson_list")->with(["course" => $course]);
    }

    public function search()
    {
        $query = Input::get("query");
        $state = 1;

        if ($query == null)
        {
            $lessons = Lesson::orderBy('ID', 'desc')->take(25)->get();
        }
        else
        {
            $option = Input::get("option");

            if ($option == 1)
            {
                if (!is_numeric($query))
                    $state = 0;

                $lessons = Lesson::where("id", $query)->get();
            }
            elseif ($option == 2)
            {
                $lessons = Lesson::where("title", 'LIKE', '%' . $query . '%')->get();

                if ($lessons->count() == 0)
                    $state = 0;
            }
            else
            {
                $lessons = Lesson::orderBy('ID', 'desc')->take(25)->get();
            }
        }

        return view("lesson.lesson_search")->with(["lessons" => $lessons, "state" => $state]);
    }

    public function info($id)
    {
        if (!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["CoursesAndLessonsAndEExam"]))
            return view("message.warning_message");

        $lesson = Lesson::find($id);
        $courses = Course::all();
        $lecturers = Lecturer::all();


        return view("lesson.lesson_info")->with([
            "lesson" => $lesson,
            "courses" => $courses,
            "lecturers" => $lecturers
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'ID' => 'numeric',
            'title' => 'required|max:256',
            'courseID' => 'required|numeric',
            'lecturerID' => 'required|numeric',
            'youtubeVideoID' => 'required|max:128'
        ], [
            'ID.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'title.required' => 'اسم الدرس فارغ.',
            'title.max' => 'اسم الدرس يجب ان لايتجاوز 256 حرف.',
            'courseID.required' => 'يجب اختيار الدورة.',
            'courseID.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'lecturerID.required' => 'يجب اختيار الأستاذ.',
            'lecturerID.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'youtubeVideoID.required' => 'VideoID فارغ.',
            'youtubeVideoID.max' => 'VideoID يجب ان لايتجاوز 128 حرف.'
        ]);

        $lesson = Lesson::find(Input::get("ID"));

        if (!$lesson)
            return redirect("/lesson/info-$lesson->ID")->with('UpdateMessage', 'لم يتم تعديل البيانات بنجاح يرجى اعادة العملية من جديد');

        $lesson->Title = Input::get("title");
        $lesson->Description = Input::get("description");
        $lesson->Course_ID = Input::get("courseID");
        $lesson->Lecturer_ID = Input::get("lecturerID");
        $lesson->YoutubeVideoId = Input::get("youtubeVideoID");

        $lesson->save();

        return redirect("/lesson/info-$lesson->ID")->with("UpdateMessage", "تم تعديل معلومات الدرس بنجاح");
    }

    public function create()
    {
        if (!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["CoursesAndLessonsAndEExam"]))
            return view("message.warning_message");

        $courses = Course::all();
        $lecturers = Lecturer::all();

        return view("lesson.create_lesson")->with(["courses" => $courses, "lecturers" => $lecturers]);
    }

    public function createValidation(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:256',
            'courseID' => 'required|numeric',
            'lecturerID' => 'required|numeric',
            'youtubeVideoID' => 'required|max:128'
        ], [
            'title.required' => 'اسم الدرس فارغ.',
            'title.max' => 'اسم الدرس يجب ان لايتجاوز 256 حرف.',
            'courseID.required' => 'يجب اختيار الدورة.',
            'courseID.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'lecturerID.required' => 'يجب اختيار الأستاذ.',
            'lecturerID.numeric' => 'تحذير !! تقوم بأرسال بيانات غير صحيحة.',
            'youtubeVideoID.required' => 'VideoID فارغ.',
            'youtubeVideoID.max' => 'VideoID يجب ان لايتجاوز 128 حرف.'
        ]);

        $lesson = new Lesson;

        $lesson->Title = Input::get("title");
        $lesson->Description = Input::get("description");
        $lesson->Course_ID = Input::get("courseID");
        $lesson->Lecturer_ID = Input::get("lecturerID");
        $lesson->UploadDate = date("Y-m-d");
        $lesson->YoutubeVideoId = Input::get("youtubeVideoID");
        $lesson->VideoLength = "00:00";

        $success = $lesson->save();

        if(!$success)
            return redirect("/lesson/create")->with("CreateMessage","لم تتم أضافة الدرس أعد المحاولة مرة أخرى");

        return redirect("/lesson/create")->with("CreateMessage","تمت أضافة الدرس بنجاح");
    }

    public function delete()
    {
        $lesson = Lesson::find(Input::get("lessonID"));
        $success = $lesson->delete();

        if (!$success)
            return redirect("/$lesson->Course_ID/lessons")->with("DeleteMessage", "لم يتم حذف الدرس بنجاح , يرجى اعادة المحاولة.");

        return redirect("/$lesson->Course_ID/lessons")->with("DeleteMessage", "تم حذف الدرس بنجاح.");;
    }
}