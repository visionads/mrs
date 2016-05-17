<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PhotographyPackage extends Model
{

    protected $table = 'photography_package';

    protected $fillable = [
        'title','price'
    ];

    //TODO : Model Relationship
    /*public function relPhotographyPackage(){
        return $this->belongsTo('App\PhotographyOptions', 'id', 'photography_package_id');
    }*/

    public function relPhotographyPackage(){
        return $this->hasMany('App\PhotographyOptions');
    }
}