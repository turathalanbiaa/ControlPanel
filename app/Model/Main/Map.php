<?php
/**
 * Created by PhpStorm.
 * User: Emad
 * Date: 8/8/2017
 * Time: 10:06 AM
 */

namespace App\Model\Main;


class Map
{
    const MAPS = array(
        "Student" => 1,
        "Lecturer" => 2,
        "CoursesAndLessonsAndEExam" => 3,
        "TimeTable" => 4,
        "Announcement" => 5,
        "ShowLecturerMessage" => 6,
        "Aqlam" => 7,
        "Library" => 8
    );


    const MAP_ADMINISTRATOR = array(
        self::MAPS['Student'],
        self::MAPS['Lecturer'],
        self::MAPS['CoursesAndLessonsAndEExam'],
        self::MAPS['TimeTable'],
        self::MAPS['Announcement'],
        self::MAPS['ShowLecturerMessage'],
        self::MAPS['Aqlam'],
        self::MAPS['Library']
    );

    const MAP_STUDENT_MANAGER = array(
        self::MAPS['Student'],
        self::MAPS['Lecturer'],
        self::MAPS['ShowLecturerMessage'],
    );

    const MAP_COURSE_MANAGER = array(
        self::MAPS['CoursesAndLessonsAndEExam'],
        self::MAPS['TimeTable'],
        self::MAPS['Announcement']
    );

    const MAP_AQLAM_AND_LIBRARY = array(
        self::MAPS["Aqlam"],
        self::MAPS["Library"]
    );
}