<?php

namespace App\Http\Controllers\DaleelAlsaam;

use App\Model\DaleelAlsaam\Calender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CalenderController extends Controller
{
    public function show()
    {
        if (!is_null(Input::get("query")))
        {
            $query = Input::get("query");
            $rows = Calender::where("city","like","%" . $query . "%")
                ->orderBy("city")
                ->orderBy("ramadanDay")
                ->get();
        } else {
            $rows = Calender::orderBy("city")->orderBy("ramadanDay")->get();
        }


        return view("daleel_alsaam.calender")->with([
            "rows" => $rows
        ]);
    }

    public function delete()
    {
        $id = Input::get("id");
        $calender = Calender::find($id);

        if (!$calender)
            return ["notFound"=>true];

        $success = $calender->delete();

        if (!$success)
            return ["success"=>false];

        return ["success"=>true];
    }

    public function add(Request $request)
    {
        return view("daleel_alsaam.add");
    }

    public function create(){
        $city = Input::get("city");
        $day = Input::get("day");
        $ramadanDay = Input::get("ramadanDay");
        $dayOfMonth = Input::get("dayOfMonth");
        $monthOfYear = Input::get("monthOfYear");
        $imsak = Input::get("imsak");
        $duhr = Input::get("duhr");
        $fajir = Input::get("fajir");
        $mog = Input::get("mogrhib");

        $calenderItem = new Calender();
        $calenderItem->city = $city;
        $calenderItem->dayName = $day;
        $calenderItem->ramadanDay = $ramadanDay;
        $calenderItem->dayOfMonth = $dayOfMonth;
        $calenderItem->monthOfYear = $monthOfYear;
        $calenderItem->imsak = $imsak;
        $calenderItem->duhr = $duhr;
        $calenderItem->fajir = $fajir;
        $calenderItem->mogrhib = $mog;

        $calenderItem->save();

        return redirect("/daleel-alsaam/add");
    }
}
