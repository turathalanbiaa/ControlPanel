<?php
/**
 * Created by PhpStorm.
 * User: Emad
 * Date: 8/9/2017
 * Time: 1:28 PM
 */

namespace App\Model\Course;


class CourseType
{
    const GENERAL_COURSE = 1;
    const STUDY_COURSE = 2;

    public static function getCourseTypeName($key)
    {
        switch ($key)
        {
            case self::GENERAL_COURSE: return "دورة عامة";
            case self::STUDY_COURSE: return "دورة منهجية";
        }

        return "";
    }

}