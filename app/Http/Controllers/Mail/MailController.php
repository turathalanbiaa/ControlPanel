<?php

namespace App\Http\Controllers\Mail;

use App\Model\EventLog\EventLog;
use App\Model\Student\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function verificationEmail(Request $request)
    {
        $studentId = Input::get("studentId");
        $verifiedEmailType = Input::get("type");

        $student = Student::find($studentId);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        if ($verifiedEmailType == 1)
        {
            if ($student->VerifiedEmail == 1)
                return redirect("/student/info-$student->ID")->with("VerifiedEmailMessage","هذا الطالب حسابه مفعل مسبقاً");

            $success = $this->sendMail($request, $student);

            if(!$success)
                return redirect("/student/info-$student->ID")->with("VerifiedEmailMessage","لم تتم عملية ارسال رسالة تفعيل الحساب الى الطالب.");

            $description = $student->ID .":-" .$student->Name;
            EventLog::addEvent(EventLog::STUDENT_EVENTS_LOG["ACTIVE ACCOUNT BY SEND MESSAGE TO EMAIL"], $description);
            return redirect("/student/info-$student->ID")->with("VerifiedEmailMessage"," تمت عملية ارسال رسالة تفعيل الحساب الى الطالب بنجاح.");
        }

        if ($verifiedEmailType == 2)
        {
            if ($student->VerifiedEmail == 1)
                return redirect("/student/info-$student->ID")->with("VerifiedEmailMessage","هذا الطالب حسابه مفعل مسبقاً");

            $student->VerifiedEmail = 1;
            $student->EmailVerificationCode = null;
            $success = $student->save();

            if (!$success)
                return redirect("/student/info-$student->ID")->with("VerifiedEmailMessage","لم يتم تفعيل حساب الطالب.");

            $description = $student->ID .":-" .$student->Name;
            EventLog::addEvent(EventLog::STUDENT_EVENTS_LOG["ACTIVE ACCOUNT BY SET 'VerifiedEmail=1'"], $description);
            return redirect("/student/info-$student->ID")->with("VerifiedEmailMessage","تم تفعيل حساب الطالب.ً");
        }

        return redirect("/student/info-$student->ID")->with("VerifiedEmailMessage","اعد محاولة تفعيل حساب الطالب.");
    }

    public function sendMail(Request $request, $student)
    {
        Mail::send('mail.mail', ['student' => $student], function ($message) use ($student)
        {
            $message->from('info@turath-alanbiaa.org', "معهد تراث الأنبياء(عليه السلام) للدراسات الحوزوية الإلكترونيه");
            $message->to($student->Email, $student->Name)->subject("تفعبل الحساب");
        });

        if (Mail::failures())
            return false;

        return true;
    }
}
