<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/9/16
 * Time: 4:27 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Package extends Model
{
    protected $table = 'package';

    protected $fillable = [
        'title',
        'slug',
        'price',
        'image_path',
        'image_thumb',
        'status'
    ];

    //TODO : Model Relationship
    /*public function relPhotographyPackage(){
        return $this->belongsTo('App\PhotographyOptions', 'id', 'photography_package_id');
    }*/

    public function relPackageOption(){
        return $this->hasMany('App\PackageOption');
    }



    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'

    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
                //$query->business_id = isset(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
                //$query->business_id = isset(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
    }

}