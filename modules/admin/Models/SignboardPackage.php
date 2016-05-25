<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/10/16
 * Time: 2:18 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class SignboardPackage extends Model
{
    protected $table = 'signboard_package';

    protected $fillable = [
        'title','image_path','image_thumb','business_id'
    ];

    //TODO : Model Relationship
    /*public function relPhotographyPackage(){
        return $this->belongsTo('App\PhotographyOptions', 'id', 'photography_package_id');
    }*/

    public function relSignboardPackage(){
        return $this->hasMany('App\SignboardPackageSize');
    }



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