<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQualification extends Model
{
    protected $fillable = [
        'student_id',
        'qualification_id',
        'year_of_passing',
        'university'
    ];
}
