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
    const INTRO_FIRST_PART_ONE = 2;
    const INTRO_FIRST_PART_TWO = 3;
    const INTRO_SECOND_PART_ONE = 4;
    const INTRO_SECOND_PART_TWO = 5;
    const INTRO_THIRD_PART_ONE = 6;
    const INTRO_THIRD_PART_TWO = 7;
    const SETOH_BEGINNER_PART_ONE = 8;
    const SETOH_BEGINNER_PART_TWO = 9;


    public static function getLevelName($levelNumber)
    {
        switch ($levelNumber)
        {
            case self::BEGINNER:
                return "المرحلة التمهيدية";
            case self::INTRO_FIRST_PART_ONE:
                return "المقدمات المرحلة الأولى المستوى الأول";
            case self::INTRO_FIRST_PART_TWO:
                return "المقدمات المرحلة الأولى المستوى الثاني";
            case self::INTRO_SECOND_PART_ONE:
                return "المقدمات المرحلة الثانية المستوى الأول";
            case self::INTRO_SECOND_PART_TWO:
                return "المقدمات المرحلة الثانية المستوى الثاني";
            case self::INTRO_THIRD_PART_ONE:
                return "المقدمات المرحلة الثالثة المستوى الأول";
            case self::INTRO_THIRD_PART_TWO:
                return "المقدمات المرحلة الثالثة المستوى الثاني";
            case self::SETOH_BEGINNER_PART_ONE:
                return "السطوح المرحلة التمهيدية المستوى الاول";
            case self::SETOH_BEGINNER_PART_TWO:
                return "السطوح المرحلة التمهيدية المستوى الثاني";
            default:
                return "";
        }
    }
}