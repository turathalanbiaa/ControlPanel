<?php
/**
 * Created by PhpStorm.
 * User: Emad
 * Date: 8/9/2017
 * Time: 9:14 AM
 */

namespace App\Model\Main;

class Login
{
    public static function isLogin()
    {
        if (isset($_SESSION["USER_ID"]))
            return true;
        else
            return false;
    }
}