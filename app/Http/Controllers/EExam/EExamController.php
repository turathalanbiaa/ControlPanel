<?php

namespace App\Http\Controllers\EExam;

use App\Model\Course\Course;
use App\Model\EExam\EExamOption;
use App\Model\EExam\EExamQuestion;
use App\Model\Lesson\Lesson;
use App\Model\Main\Authorization;
use App\Model\Main\Login;
use App\Model\Main\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class EExamController extends Controller
{
    public function addQuestion($lessonID)
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["CoursesAndLessonsAndEExam"]))
            return view("message.warning_message");

        $lesson = Lesson::find($lessonID);

        if(!$lesson)
            return view("e_exam.addQuestion")->with("NotFoundLesson", "لايوجد درس بهذا الأسم.");

        return view("e_exam.addQuestion")->with(["lesson" => $lesson]);
    }

    public function questionValidation(Request $request)
    {

        $this->validate($request,[
            "lessonID" => "required|numeric",
            "question" => "required",
            "option-1" => "required",
            "option-2" => "required",
            "option-3" => "required",
            "option-4" => "required",
            "answer"   => "required|numeric|between:1,4"
        ], [
            "lessonID.required" => "تحذير !! تقوم بأرسال بيانات غير صحيحة.",
            "lessonID.numeric"  => "تحذير !! تقوم بأرسال بيانات غير صحيحة.",
            "question.required" => "لايوجد هنالك سؤال!! يرجى وضع سؤال للدرس ان كنت ترغب في ذلك.",
            "option-1.required" => "الأختيار الأول فارغ.",
            "option-2.required" => "الأختيار الثاني فارغ.",
            "option-3.required" => "الأختيار الثالث فارغ.",
            "option-4.required" => "الأختيار الرابع فارغ.",
            "answer.required"   => "يجب أختيار الجواب الصحيح.",
            "answer.numeric"    => "تحذير !! تقوم بأرسال بيانات غير صحيحة.",
            "answer.between"    => "تحذير !! تقوم بأرسال بيانات غير صحيحة."
        ]);

        $lessonID = Input::get("lessonID");
        $lesson = Lesson::find($lessonID);

        if(!$lesson)
            return redirect("/e-exam/add-question/$lessonID");

        DB::transaction(function ()
        {
            $lesson = Lesson::find(Input::get("lessonID"));
            $eExamQuestion = new EExamQuestion;
            $eExamQuestion->Question = Input::get("question");
            $answer  = Input::get("answer");
            switch ($answer)
            {
                case '1': $eExamQuestion->Answer = Input::get("option-1"); break;
                case '2': $eExamQuestion->Answer = Input::get("option-2"); break;
                case '3': $eExamQuestion->Answer = Input::get("option-3"); break;
                case '4': $eExamQuestion->Answer = Input::get("option-4"); break;
            }
            $eExamQuestion->Lesson_ID = $lesson->ID;
            $eExamQuestion->Course_ID = $lesson->Course_ID;
            $eExamQuestion->save();

            $countOFOption = 1;
            while ($countOFOption <= 4)
            {
                $eExamOption = new EExamOption;
                $eExamOption->Question_ID = $eExamQuestion->ID;
                $eExamOption->Option = Input::get("option-".$countOFOption);
                $eExamOption->save();

                $countOFOption = $countOFOption + 1;
            }
        });

        return redirect("lesson/info-$lessonID")->with("AddQuestion", "تمت عملية أضافة سؤال الى هذا الدرس بنجاح");
    }

    public function delete()
    {

        $questionID = Input::get("questionID");
        $lessonID = Input::get("lessonID");
        $question = EExamQuestion::find($questionID);

        if(!$question)
            return redirect("/lesson/info-$lessonID")->with("NotFoundQuestion","تحذير !! تقوم بأرسال بيانات غير صحيحة.");

        DB::transaction(function ()
        {
            $questionID = Input::get("questionID");
            EExamQuestion::find($questionID)->delete();
            EExamOption::where("question_ID","=",$questionID)->delete();
        });

        return redirect("/lesson/info-$lessonID")->with("DeleteQuestion","تم حذف السؤال بنجاح.");
    }
}
