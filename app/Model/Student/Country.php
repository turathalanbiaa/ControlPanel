<?php
/**
 * Created by PhpStorm.
 * User: Emad
 * Date: 8/2/2017
 * Time: 9:01 AM
 */

namespace App\Model\Student;


class Country
{
    const COUNTRY_LIST = [
        "iq" =>  "العراق",
        "bh" =>  "البحرين",
        "dz" =>  "الجزائر",
        "sa" =>  "السودان",
        "sd" =>  "السعودية",
        "se" =>  "السويد",
        "kw" =>  "الكويت",
        "gb" =>  "المملكة المتحدة",
        "no" =>  "النرويج",
        "us" =>  "الولايات المتحدة",
        "ir" =>  "ايران",
        "pk" =>  "باكستان",
        "tn" =>  "تونس",
        "om" =>  "عمان",
        "gh" =>  "غانا",
        "lb" =>  "لبنان",
        "ly" =>  "ليبيا",
        "eg" =>  "مصر",
        "nl" =>  "هولندا",
        "other" => "أخرى"
    ];



    public static function getCountriesList()
    {
        return self::COUNTRY_LIST;
    }

    public static function getCountryName($countryCode)
    {
        return self::COUNTRY_LIST[$countryCode];
    }
}