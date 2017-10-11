<?php
/**
 * Created by PhpStorm.
 * User: Emad
 * Date: 8/1/2017
 * Time: 2:56 PM
 */

namespace App\Model\Student;


class ScientificDegree
{
    const RELIGION = 1;
    const INTERMEDIATE_SCHOOL = 2;
    const HIGH_SCHOOL = 3;
    const DIPLOMA = 4;
    const BACHELORS = 5;
    const MASTER = 6;
    const PHD = 7;
    const OTHER = 8;

    public static function getScientificDegree($number)
    {
        switch ($number)
        {
            case ScientificDegree::RELIGION:
                return "حوزوي";
            case ScientificDegree::INTERMEDIATE_SCHOOL:
                return "متوسطة";
            case ScientificDegree::HIGH_SCHOOL:
                return "أعدادية";
            case ScientificDegree::DIPLOMA:
                return "دبلوم";
            case ScientificDegree::BACHELORS:
                return "بكالوريوس";
            case ScientificDegree::MASTER:
                return "دراسات عليا";
            case ScientificDegree::PHD:
                return "دكتوراه";
            case ScientificDegree::OTHER:
                return "أخرى";
        }
    }
}