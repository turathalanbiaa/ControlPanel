<?php

namespace App\Http\Controllers\Student;

use App\Model\Announcement\Announcement;
use App\Model\EventLog\EventLog;
use App\Model\Main\Authorization;
use App\Model\Main\Login;
use App\Model\Main\Map;
use App\Model\Message\Message;
use App\Model\Student\Student;
use App\Model\Student\StudentPaper;
use App\Model\Student\StudentType;
use App\Http\Controllers\Controller;
//use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class StudentController extends Controller
{
    public function showAll()
    {
        if (!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        $pageSize = 50;

        if (isset($_GET['page_num']))
            $pageNumber = $_GET['page_num'];
        else
            $pageNumber = 1;

        $studentsCount = Student::all()->count();
        $pagesCount = ceil($studentsCount / $pageSize);

        $students = Student::student($pageNumber, $pageSize);

        return view("student.student")->with([
            "students" => $students,
            "pagesCount" => $pagesCount
        ]);
    }

    public function search()
    {
        if (!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        $query = Input::get("query");
        $optionSearch = Input::get("option");

        if ($query == '')
            return redirect("/students/show");

        switch ($optionSearch) {
            case 1 :
                $students = Student::where('ID', '=', $query)->get();
                break;
            case 2 :
                $students = Student::where('name', 'LIKE', '%' . $query . '%')->get();
                break;
            case 3 :
                $students = Student::where('email', 'LIKE', '%' . $query . '%')->get();
                break;
            case 4 :
                $students = Student::where('level', '=', $query)->get();
                break;
            case 5 :
                $students = Student::where('gender', '=', $query)->get();
                break;
            default:
                $students = Student::where('name', 'LIKE', '%' . $query . '%')->get();
        }

        return view("student.student")->with([
            'students' => $students
        ]);
    }

    public function create($accountType)
    {
        if (!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        $accountTypes = array(
            StudentType::LEGAL_STUDENT,
            StudentType::LISTENER
        );

        if (!in_array($accountType, $accountTypes))
            return redirect('/students/show')->with('ChooseAccountMessage', 'يرجى اختيار نوع الحساب الذي تود انشاءه بالشكل الصحيح.');

        return view("student.student_create")->with("accountType", $accountType);
    }

    public function createValidation(Request $request)
    {
        $accountType = Input::get("accountType");

        switch ($accountType) {
            case StudentType::LEGAL_STUDENT :
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required|email|unique:student,Email',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6',
                    'phone' => 'required',
                    'gender' => 'required',
                    'country' => 'required',
                    'level' => 'required',
                    'scientific_degree' => 'required',
                    'birthdate' => 'required|date',
                    'address' => 'required',
                ], [
                    'name.required' => 'الأسم فارغ.',
                    'email.required' => 'البريد الإلكتروني فارغ.',
                    'email.unique' => 'البريد الإلكتروني موجود مسبقا.',
                    'password.required' => 'حقل كلمة المرور فارغ.',
                    'password_confirmation.required' => 'حقل اعد كتابة كلمة المرور فارغ.',
                    'password.min' => 'كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
                    'password_confirmation.min' => 'اعد كتابة كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
                    'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
                    'phone.required' => 'الهاتف فارغ.',
                    'gender.required' => 'يجب اختيار الجنس.',
                    'country.required' => 'يجب اختيار البلد.',
                    'level.required' => 'يجب اختيار المرحلة.',
                    'scientific_degree.required' => 'يجب اختيار الشهادة.',
                    'birthdate.required' => 'تاريخ الميلاد فارغ.',
                    'address.required' => 'حقل العنوان فارغ.',
                ]);
                break;
            case StudentType::LISTENER :
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required|email|unique:student,Email',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6',
                    'phone' => 'required',
                    'gender' => 'required',
                    'country' => 'required',
                ], [
                    'name.required' => 'الأسم فارغ.',
                    'email.required' => 'البريد الإلكتروني فارغ.',
                    'email.unique' => 'البريد الإلكتروني موجود مسبقا.',
                    'password.required' => 'كلمة المرور فارغه.',
                    'password_confirmation.required' => 'حقل اعد كتابة كلمة المرور فارغ.',
                    'password.min' => 'حقل كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
                    'password_confirmation' => 'حقل اعد كتابة كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
                    'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
                    'phone.required' => 'الهاتف فارغ.',
                    'gender.required' => 'يرجى اختيار الجنس.',
                    'country.required' => 'يرجى اختيار البلد.',
                ]);
                break;
            default :
                return redirect('/students/show')->with('ChooseAccountMessage', 'يرجى اختيار نوع الحساب الذي تود انشاءه بالشكل الصحيح.');
        }

        $student = new Student;

        if ($accountType == StudentType::LEGAL_STUDENT) {
            $student->Level = Input::get("level");
            $student->Group = Input::get("group");
            $student->ScientificDegree = Input::get("scientificDegree");
            $student->Birthdate = Input::get("birthdate");
            $student->Address = Input::get("address");
        }

        if ($accountType == StudentType::LISTENER) {
            $student->Level = 10;
            $student->Group = null;
            $student->ScientificDegree = null;
            $student->Birthdate = null;
            $student->Address = null;
        }

        $student->Name = Input::get("name");
        $student->Email = Input::get("email");
        $student->Password = md5(Input::get("password"));
        $student->Phone = Input::get("phone");
        $student->Gender = Input::get("gender");
        $student->Country = Input::get("country");
        $student->Type = Input::get("accountType");
        $student->RegisterDate = date("Y-m-d");
        $student->VerifiedEmail = 1;
        $student->EmailVerificationCode = null;
        $student->Image = "student.png";
        $student->Supervisor = null;
        $student->SessionID = null;

        $success = $student->save();

        if (!$success)
            return redirect("/student/create/$accountType")->with('CreateAccountMessage', 'لم يتم اضافة الطالب أعد المحاولة مرة أخرى.');

        $description = $student->ID . ":-" . $student->Name;
        EventLog::addEvent(EventLog::STUDENT_EVENTS_LOG["ADD STUDENT"], $description);
        return redirect("/student/create/$accountType")->with('CreateAccountMessage', 'تمت عملية انشاء الحساب بنجاح.');
    }

    public function delete()
    {
        $ID = Input::get("studentID");
        $student = Student::find($ID);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        $success = $student->delete();

        if (!$success)
            return redirect("/students/show")->with('DeleteMessage', "لم يتم حذف الطالب يرجى المحاولة مرة أخرى");

        $description = $student->ID . ":-" . $student->Name;
        EventLog::addEvent(EventLog::STUDENT_EVENTS_LOG["DELETE STUDENT"], $description);
        return redirect("/students/show")->with('DeleteMessage', "تم حذف الطالب بنجاح");
    }

    public function info($id)
    {
        if (!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        $student = Student::find($id);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        return view("student.student_info")->with('student', $student);
    }

    public function update(Request $request)
    {
        $id = Input::get("ID");
        $student = Student::find($id);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        if ($student->Type == StudentType::LEGAL_STUDENT) {
            $this->validate($request, [
                'name' => 'required',
                'email' => ['required', Rule::unique('student')->ignore($id)],
                'phone' => 'required',
                'gender' => 'required',
                'country' => 'required',
                'birthdate' => 'required|date',
                'level' => 'required',
                'scientific_degree' => 'required',
                'address' => 'required',
            ], [
                'name.required' => 'يجب ادخال اسم الطالب الرباعي واللقب.',
                'email.required' => 'البريد الإلكتروني فارغ.',
                'email.unique' => 'البريد الإلكتروني موجود مسبقا.',
                'phone.required' => 'الهاتف فارغ.',
                'gender.required' => 'يرجى اختيار الجنس.',
                'country.required' => 'يرجى اختيار البلد.',
                'birthdate.required' => 'تاريخ الميلاد فارغ.',
                'level.required' => 'يرجى اختيار المرحلة.',
                'scientific_degree.required' => 'يرجى اختيار الشهادة.',
                'address.required' => 'العنوان فارغ.',
            ]);

            $student->Name = Input::get("name");
            $student->RecordNumber = Input::get("recordNumber");
            $student->Email = Input::get("email");
            $student->Phone = Input::get("phone");
            $student->Gender = Input::get("gender");
            $student->Country = Input::get("country");
            $student->Birthdate = Input::get("birthdate");
            $student->Level = Input::get("level");
            $student->Group = Input::get("group");
            $student->ScientificDegree = Input::get("scientific_degree");
            $student->Address = Input::get("address");
        }

        if ($student->Type == StudentType::LISTENER) {
            $this->validate($request, [
                'name' => 'required',
                'email' => ['required', Rule::unique('student')->ignore($id)],
                'phone' => 'required',
                'gender' => 'required',
                'country' => 'required'
            ], [
                'name.required' => 'يجب ادخال اسم الطالب الرباعي واللقب.',
                'email.required' => 'البريد الإلكتروني فارغ.',
                'email.unique' => 'البريد الإلكتروني موجود مسبقا.',
                'phone.required' => 'الهاتف فارغ.',
                'gender.required' => 'يرجى اختيار الجنس.',
                'country.required' => 'يرجى اختيار البلد.'
            ]);

            $student->Name = Input::get("name");
            $student->Email = Input::get("email");
            $student->Phone = Input::get("phone");
            $student->Gender = Input::get("gender");
            $student->Country = Input::get("country");
        }

        $success = $student->save();

        if (!$success)
            return redirect("/student/info-$student->ID")->with('UpdateMessage', 'لم يتم تعديل البيانات بنجاح يرجى اعادة العملية من جديد');

        $description = $student->ID . ":-" . $student->Name;
        EventLog::addEvent(EventLog::STUDENT_EVENTS_LOG["UPDATE STUDENT"], $description);
        return redirect("/student/info-$student->ID")->with('UpdateMessage', 'تم تعديل بيانات الطالب بنجاح.');
    }

    public function changePassword($id)
    {
        if (!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        $student = Student::find($id);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        return view("student.change_password")->with(["student" => $student]);
    }

    public function changePasswordValidation(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ], [
            'password.required' => 'كلمة المرور فارغه.',
            'password_confirmation.required' => 'اعد كتابة كلمة المرور فارغه.',
            'password.min' => 'كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
            'password_confirmation.min' => 'اعد كتابة كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
        ]);

        $Id = Input::get("ID");
        $password = Input::get("password");

        $student = Student::find($Id);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        $student->Password = md5($password);
        $success = $student->save();

        if (!$success)
            return redirect("/student/info-$student->ID")->with('ChangePasswordMessage', "لم يتم تغيير كلمة المرور الطالب " . $student->Name . " يرجى المحاولة مرة أخرى");


        $description = $student->ID . ":-" . $student->Name;
        EventLog::addEvent(EventLog::STUDENT_EVENTS_LOG["CHANGE PASSWORD"], $description);
        return redirect("/student/info-$student->ID")->with('ChangePasswordMessage', "تم تغيير كلمة المرور الطالب : " . $student->Name);
    }

    public function convertStudentType()
    {
        $studentId = Input::get("studentId");
        $student = Student::find($studentId);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        if ($student->Type == StudentType::LEGAL_STUDENT) {
            $student->Type = StudentType::LISTENER;
            $student->Level = 10;
            $student->ScientificDegree = null;
            $student->Birthdate = null;
            $student->Address = null;
            $student->Group = null;
            $success = $student->save();

            if (!$success)
                return redirect("/student/info-$student->ID")->with("ConvertTypeMessage", "لم يتم تحويل حساب الطالب الى مستمع، اعد المحاولة مرة أخرى.");

            $description = $student->ID . ":-" . $student->Name;
            EventLog::addEvent(EventLog::STUDENT_EVENTS_LOG["CONVERT LEGAL STUDENT TO LISTENER"], $description);
            return redirect("/student/info-$student->ID")->with("ConvertTypeMessage", "تم تحويل حساب الطالب الى مستمع.");
        }

        if ($student->Type == StudentType::LISTENER)
            return redirect("/student/convert-listener-to-student?id=$student->ID");

        return redirect("/student/info-$student->ID");
    }

    public function convertListenerToStudent()
    {
        if (!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        $ID = Input::get("id");
        $student = Student::find($ID);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        return view("student.listener_to_legalStudent")->with(["student" => $student]);
    }

    public function convertListenerToStudentValidation(Request $request)
    {
        $ID = Input::get("ID");
        $student = Student::find($ID);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        $this->validate($request, [
            'ID' => 'numeric',
            'name' => 'required',
            'email' => ['required', Rule::unique('student')->ignore($student->ID)],
            'level' => 'required',
            'group' => 'required',
            'scientificDegree' => 'required',
            'birthdate' => 'required|date',
            'address' => 'required',
        ], [
            'ID.numeric' => 'تحذير !!! انت تقوم بأرسال بيانات خاطئه.',
            'name.required' => 'حقل الأسم فارغ.',
            'email.required' => 'البريد الإلكتروني فارغ.',
            'email.unique' => 'البريد الإلكتروني موجود مسبقا.',
            'level.required' => 'يجب اختيار المرحلة.',
            'group.required' => 'حقل الشعبة فارغ.',
            'scientificDegree.required' => 'يجب اختيار الشهادة.',
            'birthdate.required' => 'حق تاريخ الميلاد فارغ.',
            'address.required' => 'حقل العنوان فارغ.'
        ]);

        $student->Type = StudentType::LEGAL_STUDENT;
        $student->Name = Input::get("name");
        $student->Birthdate = Input::get("birthdate");
        $student->Level = Input::get("level");
        $student->Group = Input::get("group");
        $student->ScientificDegree = Input::get("scientificDegree");
        $student->Address = Input::get('address');

        $success = $student->save();

        if (!$success)
            return redirect("/student/info-$student->ID")->with('ConvertListenerToStudentMessage', "لم يتم تحويل المستع ( " . $student->Name . " ) الى طالب، يرجى اعادة المحاولة.");

        $description = $student->ID . ":-" . $student->Name;
        EventLog::addEvent(EventLog::STUDENT_EVENTS_LOG["CONVERT LISTENER TO LEGAL STUDENT"], $description);
        return redirect("/student/info-$student->ID")->with('ConvertListenerToStudentMessage', "تم تحويل الحساب من مستمع الى طالب : " . $student->Name);
    }

    public function paper()
    {
        $id = Input::get("id");
        $student = Student::find($id);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        $papers = ["1" => [], "2" => [], "3" => []];
        foreach ($student->Paper as $paper) {
            $key = $paper->Type;

            switch ($key) {
                case 1:
                    $papers["1"] = $paper;
                    break;
                case 2:
                    $papers["2"] = $paper;
                    break;
                case 3:
                    $papers["3"] = $paper;
                    break;
            }
        }

        $description = $student->ID . ":-" . $student->Name;
        EventLog::addEvent(EventLog::STUDENT_PAPER_LOG["SHOW PAPERS"], $description);
        return view("student.student_paper")->with(["student" => $student, "papers" => $papers]);
    }

    public function acceptPaper()
    {
        $id = Input::get("paperId");
        $paper = StudentPaper::find($id);

        if (is_null($paper))
            return ["success" => null];

        $paper->State = 1;
        $success = $paper->save();

        if (!$success)
            return ["success" => false];

        $student = Student::find($paper->Student_ID);

        if (is_null($student))
            return ["success" => null];

        $description = $student->ID . ":-" . $student->Name . "\n" . $this->getPaperName($paper->Type);
        EventLog::addEvent(EventLog::STUDENT_PAPER_LOG["ACCEPT PAPER"], $description);
        return ["success" => true];
    }

    public function rejectPaper()
    {
        $id = Input::get("paperId");
        $paper = StudentPaper::find($id);

        if (is_null($paper))
            return ["success" => null];

        $paper->State = 2;
        $success = $paper->save();
        if (!$success)
            return ["success" => false];

        $student = Student::find($paper->Student_ID);

        if (is_null($student))
            return ["success" => null];

        $description = $student->ID . ":-" . $student->Name . "\n" . $this->getPaperName($paper->Type);
        EventLog::addEvent(EventLog::STUDENT_PAPER_LOG["REJECT PAPER"], $description);
        return ["success" => true];
    }

    public function getPaperName($paperType)
    {
        switch ($paperType) {
            case 1:
                return "الهوية الشخصية";
                break;
            case 2:
                return "التزكية الدينية";
                break;
            case 3:
                return "الشهادة العلمية";
                break;
        }
        return "";
    }

    public function female_message(Request $request)
    {

        $mymessage = Input::get("mymessage2");

        $students = Student::where('gender', '=', 'female')->get();
        foreach ($students as $student) {

            $message = new Message();
            $message->Message = $mymessage;
            $message->Time = date("Y-m-d");
            $message->Sender = 11;
            $message->Target = $student->ID;
            $message->SenderType = 2;
            $message->watched = 0;
            $message->save();


        }
        return redirect('/student_message');
    }

    public function add_announcement(Request $request)
    {

        $announcement = new Announcement();
        $announcement->Title = Input::get("Title");
        $announcement->Content = Input::get("Content");
        $announcement->Image = "m6.png";
        $announcement->Type = 1;
        $announcement->Date = date("Y-m-d");
        $announcement->Activity = 1;
        $announcement->save();

        return redirect('/add_announcement');
    }

    public function student_announcement()
    {
        return view('announcement.announcement');
    }

    public function male_message(Request $request)
    {
        $mymessage = Input::get("mymessage");
        $students = Student::where('gender', '=', 'male')->get();
        foreach ($students as $student) {

            $message = new Message();
            $message->Message = $mymessage;
            $message->Time = date("Y-m-d");
            $message->Sender = 11;
            $message->Target = $student->ID;
            $message->SenderType = 2;
            $message->watched = 0;
            $message->save();

        }

       return redirect('/student_message');
    }

    public function student_message()
    {
        return view('student.add_message');
    }
}


























