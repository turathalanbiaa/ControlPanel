<?php
/**
 * Created by PhpStorm.
 * User: Emad
 * Date: 8/9/2017
 * Time: 9:32 AM
 */

namespace App\Model\Main;


class Authorization
{
    public static function authorize($map)
    {
        if (in_array($map, $_SESSION['MAP']))
            return true;
        else
            return false;
    }
}