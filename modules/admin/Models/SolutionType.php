<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class SolutionType extends Model
{

    protected $table = 'solution_type';

    protected $fillable = [
        'title',
        'description'
    ];

}