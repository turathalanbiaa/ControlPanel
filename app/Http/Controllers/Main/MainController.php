<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Model\Main\Admin;
use App\Model\Main\AdminType;
use App\Model\Main\Login;
use App\Model\Main\Map;
use Illuminate\Support\Facades\Input;

class MainController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION["USER_ID"]))
            return redirect("/login");

        return view("main.main");
    }

    public function login()
    {
        if (!Login::isLogin())
            return view("main.login");

        return redirect('/');
    }

    public function loginValidation(Request $request)
    {
        $username = Input::get("username");
        $password = Input::get("password");

        $this->validate($request, [
            'username' => 'required|exists:admin,username',
            'password' => 'required|min:6'
        ], [
            'username.required' => 'يرجى ادخال اسم المستخدم.',
            'username.exists' => 'اسم المستخدم غير موجود.',
            'password.required' => 'يرجى أدخال كلمة المرور.',
            'password.min' => 'يجب ان تكون كلمة المرور لاتقل عن 6 حروف.',
        ]);

        $success = Admin::where('username','=', $username)->where('password','=', md5($password))->first();

        if (!$success)
            return redirect('/login')->with('ErrorRegisterMessage', 'تسجيل الدخول غير صحيح ! يرجى أعادة المحاولة.');

        $_SESSION["USER_ID"] = $success->ID;
        $_SESSION["USER_TYPE"] = $success->Type;

        switch ($success->Type)
        {
            case AdminType::ADMINISTRATOR:
                $_SESSION['MAP'] = Map::MAP_ADMINISTRATOR; break;
            case AdminType::STUDENT_MANAGER:
                $_SESSION['MAP'] = Map::MAP_STUDENT_MANAGER; break;
            case AdminType::COURSE_MANAGER:
                $_SESSION{'MAP'} = Map::MAP_COURSE_MANAGER; break;
        }

        return redirect('/')->with("SuccessRegisterMessage" , 'تم تسجيل الدخول الى لوحة التحكم بنجاح');
    }

    public function redirect()
    {
        //GET FROM SESSION
        $sessionUserType = $_SESSION["USER_TYPE"];
        $sessionMap = $_SESSION['MAP'];

        //GET THIS INFO FROM FORM
        $map = Input::get("map");
        $userType = Input::get("type");

        if ($sessionUserType <> $userType)
            return view("message.warning_message");

        if(!in_array($map, $sessionMap))
            return view("message.warning_message");

        switch ($map)
        {
            case Map::MAPS['Student']:
                return redirect("/students/show");

            case Map::MAPS['Lecturer']:
                return redirect('/lecturers/show');

            case Map::MAPS['CoursesAndLessonsAndEExam']:
                return redirect('/courses/show');

            case Map::MAPS['TimeTable']:
                return redirect("/timetable");

            case Map::MAPS['Announcement']:
                return "this Announcement page";

            case Map::MAPS['ShowLecturerMessage']:
                return "this ShowLecturerMessage page";
        }

        return view("message.warning_message");
    }

}
