<?php
/**
 * Created by PhpStorm.
 * User: Emad
 * Date: 7/30/2017
 * Time: 2:37 PM
 */

namespace App\Model\Student;


class Level
{
    const BEGINNER = 1;
    const FIRST_LEVEL_INTRO = 2;
    const SECOND_LEVEL_INTRO = 3;
    const THIRD_LEVEL_INTRO = 4;
    const FIRST_LEVEL_UP = 5;
    const SECOND_LEVEL_UP = 6;
    const THIRD_LEVEL_UP = 7;


    public static function getLevelName($levelNumber)
    {
        switch ($levelNumber)
        {
            case Level::BEGINNER:
                return "تمهيدي";
            case Level::FIRST_LEVEL_INTRO:
                return "مقدمات مرحلة اولى";
            case Level::SECOND_LEVEL_INTRO:
                return "مقدمات مرحلة ثانية";
            case Level::THIRD_LEVEL_INTRO:
                return "مقدمات مرحلة ثالثة";
            case Level::FIRST_LEVEL_UP:
                return "سطوح مرحلة اولى";
            case Level::SECOND_LEVEL_UP:
                return "سطوح مرحلة ثانية";
            case Level::THIRD_LEVEL_UP:
                return "سطوح مرحلة ثالثة";
            default:
                return "مستمع";
        }
    }
}