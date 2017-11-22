<?php
/**
 * Created by PhpStorm.
 * User: Emad
 * Date: 11/20/2017
 * Time: 1:39 PM
 */

namespace App\Model\Main;


class Date
{
    public static function getArabicDay($date)
    {
        $d = strtotime($date);
        $key = date("D", $d);

        switch ($key)
        {
            case "Sat" : return "السبت";   break;
            case "Sun" : return "الاحد";    break;
            case "Mon" : return "الاثنين";  break;
            case "Tue" : return "الثلاثاء"; break;
            case "Wed" : return "الاربعاء"; break;
            case "Thu" : return "الخميس";  break;
            case "Fri" : return "الجمعه";  break;
        }

        return "";
    }
}