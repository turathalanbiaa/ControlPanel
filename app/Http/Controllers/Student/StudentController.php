<?php

namespace App\Http\Controllers\Student;

use App\Model\Main\Authorization;
use App\Model\Main\Login;
use App\Model\Main\Map;
use App\Model\Student\Student;
use App\Model\Student\StudentType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function showAll()
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        $pageSize = 50;

        if(isset($_GET['page_num']))
            $pageNumber = $_GET['page_num'];
        else
            $pageNumber = 1;

        $studentsCount = Student::all()->count();
        $pagesCount = ceil($studentsCount / $pageSize);

        $students = Student::student($pageNumber,$pageSize);

        return view("student.student")->with([
            "students" => $students,
            "pagesCount" => $pagesCount
        ]);
    }

    public function search()
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        $query = Input::get("query");
        $optionSearch = Input::get("option");

        if($query == '')
            return redirect("/students/show");

        if($optionSearch == 1)
        {
            //Search about student using id.
            $students = Student::find($query);
        }
        if($optionSearch == 2)
        {
            //Search about student using name.
            $students = Student::where('name', 'LIKE', '%'.$query.'%')->get();
        }
        elseif($optionSearch == 3)
        {
            //Search about student using email.
            $students = Student::where('email', 'LIKE', '%'.$query.'%')->get();
        }
        else
        {
            $students = Student::where('name', 'LIKE', '%'.$query.'%')->get();
        }

        return view("student.student")->with([
            'students' => $students
        ]);
    }

    public function create($accountType)
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        if ($accountType == StudentType::LEGAL_STUDENT)
        {
            return view("student.student_create")->with("accountType",$accountType);
        }
        elseif ($accountType == StudentType::LISTENER)
        {
            return view("student.student_create")->with("accountType",$accountType);
        }
        else
        {
            return redirect('/students/show')->with('ChooseAccountMessage', 'يرجى اختيار نوع الحساب الذي تود انشاءه بالشكل الصحيح.');
        }
    }

    public function createValidation(Request $request)
    {
        $accountType = Input::get("accountType");

        if ($accountType == StudentType::LEGAL_STUDENT)
        {
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required|email|unique:student',
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
                'name.required' => 'حقل الأسم فارغ.',
                'email.required' => 'حقل البريد الإلكتروني فارغ.',
                'email.unique' => 'البريد الإلكتروني موجود مسبقا.',
                'password.required' => 'حقل كلمة المرور فارغه.',
                'password_confirmation.required' => 'حقل اعد كتابة كلمة المرور فارغه.',
                'password.min' => 'حقل كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
                'password_confirmation.min' => 'حقل اعد كتابة كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
                'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
                'phone.required' => 'حقل الهاتف فارغ.',
                'gender.required' => 'يجب اختيار الجنس.',
                'country.required' => 'يجب اختيار البلد.',
                'level.required' => 'يجب اختيار المرحلة.',
                'scientific_degree.required' => 'يجب اختيار الشهادة.',
                'birthdate.required' => 'حق تاريخ الميلاد فارغ.',
                'address.required' => 'حقل العنوان فارغ.',
            ]);

        }
        elseif ($accountType == StudentType::LISTENER)
        {
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required|email|unique:student',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
                'phone' => 'required',
                'gender' => 'required',
                'country' => 'required',
            ], [
                'name.required' => 'حقل الأسم فارغ.',
                'email.required' => 'حقل البريد الإلكتروني فارغ.',
                'email.unique' => 'البريد الإلكتروني موجود مسبقا.',
                'password.required' => 'حقل كلمة المرور فارغه.',
                'password_confirmation.required' => 'حقل اعد كتابة كلمة المرور فارغه.',
                'password.min' => 'حقل كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
                'password_confirmation' => 'حقل اعد كتابة كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
                'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
                'phone.required' => 'حقل الهاتف فارغ.',
                'gender.required' => 'يرجى اختيار الجنس.',
                'country.required' => 'يرجى اختيار البلد.',
            ]);
        }
        else
        {
            return redirect('/students/show')->with('ChooseAccountMessage', 'يرجى اختيار نوع الحساب الذي تود انشاءه بالشكل الصحيح.');
        }

        $student = new Student;

        if($accountType == StudentType::LEGAL_STUDENT)
        {
            $student->Level = Input::get("level");
            $student->Group = Input::get("group");
            $student->ScientificDegree = Input::get("scientificDegree");
            $student->Birthdate = Input::get("birthdate");
            $student->Address = Input::get("address");
        }

        if($accountType == StudentType::LISTENER)
        {
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
        $student->Image = null;
        $student->Supervisor = null;
        $student->SessionID = null;

        $success = $student->save();

        if (!$success)
            return redirect("/student/create/$accountType")->with('CreateAccountMessage', 'لم يتم اضافة الطالب أعد المحاولة مرة أخرى.');

        return redirect("/student/create/$accountType")->with('CreateAccountMessage', 'تمت عملية انشاء الحساب بنجاح.');
    }

    public function delete()
    {
        $ID = Input::get("studentID");

        $student = Student::find($ID);

        if(!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        $success = $student->delete();

        if(!$success)
            return redirect("/students/show")->with('DeleteMessage', "لم يتم حذف الطالب يرجى المحاولة مرة أخرى");

        return redirect("/students/show")->with('DeleteMessage', "تم حذف الطالب بنجاح");
    }

    public function info($id)
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        $student = Student::find($id);

        if(!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        return view("student.student_info")->with('student',$student);
    }

    public function update(Request $request)
    {
        $id = Input::get("ID");
        $student = Student::find($id);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        if ($student->Type == StudentType::LEGAL_STUDENT)
        {
            $this->validate($request, [
                'name' => 'required',
                'email' => ['required', Rule::unique('student')->ignore($id)],
                'phone' => 'required',
                'gender' => 'required',
                'country' => 'required',
                'birthdate' => 'required|date',
                'level' => 'required',
                'group' => 'required',
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
                'group.required' => 'يجب ادخال الشعبة.',
                'scientific_degree.required' => 'يرجى اختيار الشهادة.',
                'address.required' => 'العنوان فارغ.',
            ]);

            $student->Name = Input::get("name");
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

        if ($student->Type == StudentType::LISTENER)
        {
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

        return redirect("/student/info-$student->ID")->with('UpdateMessage', 'تم تعديل بيانات الطالب بنجاح.');
    }

    public function changePassword($id)
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Student"]))
            return view("message.warning_message");

        $student = Student::find($id);

        if(!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        return view("student.change_password")->with(["student" => $student]);
    }

    public function changePasswordValidation(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ], [
            'password.required' => 'حقل كلمة المرور فارغه.',
            'password_confirmation.required' => 'حقل اعد كتابة كلمة المرور فارغه.',
            'password.min' => 'حقل كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
            'password_confirmation.min' => 'حقل اعد كتابة كلمة المرور قصيرة,يجب ان تتكون كلمة المرور من 6 أحرف على الأقل.',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
        ]);

        $Id = Input::get("ID");
        $password = Input::get("password");

        $student = Student::find($Id);

        if(!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        $student->Password = md5($password);
        $success = $student->save();

        if(!$success)
            return redirect("/student/info-$student->ID")->with('ChangePasswordMessage', "لم يتم تغيير كلمة المرور الطالب ".$student->Name." يرجى المحاولة مرة أخرى");

        return redirect("/student/info-$student->ID")->with('ChangePasswordMessage', "تم تغيير كلمة المرور الطالب : ".$student->Name);
    }

    public function convertStudentType()
    {
        $studentId = Input::get("studentId");
        $student = Student::find($studentId);

        if (!$student)
            return redirect("/students/show")->with('InfoMessage', "لا يوجد مثل هذا طالب لعرض معلوماته.");

        if($student->Type == StudentType::LEGAL_STUDENT)
        {
            $student->Type = StudentType::LISTENER;
            $student->Level = 10;
            $student->ScientificDegree = null;
            $student->Birthdate = null;
            $student->Address = null;
            $student->Group = null;
            $success = $student->save();

            if (!$success)
                return redirect("/student/info-$student->ID")->with("ConvertTypeMessage","لم يتم تحويل حساب الطالب الى مستمع، اعد المحاولة مرة أخرى.");

            return redirect("/student/info-$student->ID")->with("ConvertTypeMessage","تم تحويل حساب الطالب الى مستمع.");
        }

        if ($student->Type == StudentType::LISTENER)
            return redirect("/student/convert-listener-to-student?id=$student->ID");

        return redirect("/student/info-$student->ID");
    }

    public function convertListenerToStudent()
    {
        if(!Login::isLogin())
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

        $this->validate($request,[
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

        if(!$success)
            return redirect("/student/info-$student->ID")->with('ConvertListenerToStudentMessage', "لم يتم تحويل المستع ( ".$student->Name." ) الى طالب، يرجى اعادة المحاولة.");

        return redirect("/student/info-$student->ID")->with('ConvertListenerToStudentMessage', "تم تحويل الحساب من مستمع الى طالب : ".$student->Name);
    }






    public function paper()
    {
        $id = Input::get("id");
        $student = Student::find($id);

        abort(404);
        die();

        if (!$student)
            return redirect("/student/info-$student->ID");

        return view("student.student_paper");
    }
}


























