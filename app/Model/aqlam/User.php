<?php

namespace App\Model\Aqlam;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $casts = [
        'id' => 'string',
    ];
}
