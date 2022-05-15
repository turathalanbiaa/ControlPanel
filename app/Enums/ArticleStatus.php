<?php


namespace App\Enums;


class ArticleStatus
{
    const REVIEW = 1;
    const ACCEPTED = 2;
    const REJECTED = 3;

    public static function getStatus()
    {
        return array(
            self::REVIEW,
            self::ACCEPTED,
            self::REJECTED
        );
    }
}