<?php

namespace App\Http\Controllers\Lecturer;

use App\Model\Course\Course;
use App\Model\Lecturer\Lecturer;
use App\Model\Main\Authorization;
use App\Model\Main\Login;
use App\Model\Main\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LecturerController extends Controller
{
    public function showAll()
    {
        if(!Login::isLogin())
            return redirect("/login");

        if(!Authorization::authorize(Map::MAPS["Lecturer"]))
            return view("message.warning_message");

        $lecturers = Lecturer::all();
        return view("lecturer.lecturer")->with(["lecturers" => $lecturers]);
    }

    public function search()
    {
        $query = Input::get("query");
        $lecturers = Lecturer::where("name", 'LIKE', '%'.$query.'%')->get();

        return view("lecturer.lecturer")->with("lecturers", $lecturers);
    }

    public function info($id)
    {
        if(!Login::isLogin())
            return redirect("/login");

        if (!Authorization::authorize(Map::MAPS["Lecturer"]))
            return view("message.warning_message");

        $lecturer = Lecturer::find($id);

        if($lecturer == null)
            return view("lecturer.lecturer_info")->with(["NotFoundLecturer" => "لايوجد استاذ بهذا الأسم."]);

        $courses = Course::where('ID', '=', $lecturer->ID)->get();

        return view("lecturer.lecturer_info")->with([
            "lecturer" => $lecturer,
            "courses" => $courses
        ]);
    }

    public function create() {
        dd("OK");
    }
}
