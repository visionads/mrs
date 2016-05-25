<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class LocalMediaOptions extends Model
{

    protected $table = 'local_media_option';

    protected $fillable = [
        'local_media_id',
        'title',
        'price',
        'business_id'
    ];




    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'

    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
                $query->business_id = iseet(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
                $query->business_id = iseet(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
    }
}