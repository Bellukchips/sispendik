<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    protected $table = "schools";
    protected $guarded = [];

    public static function totalStudent()
    {
        return School::where('status','0')->count();
    }
}
