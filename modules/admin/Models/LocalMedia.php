<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class LocalMedia extends Model
{

    protected $table = 'local_media';

    protected $fillable = [
        'title',
        'description',
        'business_id'
    ];

    // TODO : Model Relationship
    /*public function relPhotographyPackage(){
        return $this->belongsTo('App\PhotographyOptions', 'id', 'photography_package_id');
    }*/

    public function relLocalMedia(){
        return $this->hasMany('App\LocalMediaOptions');
    }



    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'

    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
                $query->business_id = isset(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
                $query->business_id = isset(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
    }
}