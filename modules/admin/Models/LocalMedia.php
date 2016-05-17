<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class LocalMedia extends Model
{

    protected $table = 'local_media';

    protected $fillable = [
        'title',
        'description'
    ];

    // TODO : Model Relationship
    /*public function relPhotographyPackage(){
        return $this->belongsTo('App\PhotographyOptions', 'id', 'photography_package_id');
    }*/

    public function relLocalMedia(){
        return $this->hasMany('App\LocalMediaOptions');
    }
}