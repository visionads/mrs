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
        'title','image_path','image_thumb'
    ];

    //TODO : Model Relationship
    /*public function relPhotographyPackage(){
        return $this->belongsTo('App\PhotographyOptions', 'id', 'photography_package_id');
    }*/

    public function relSignboardPackage(){
        return $this->hasMany('App\SignboardPackageSize');
    }

}