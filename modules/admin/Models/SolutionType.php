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

    public function quote(){
        return $this->belongsTo('App\Quote','id','solution_type_id');
    }

}