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


class PrintMaterial extends Model
{
    protected $table = 'print_material';

    protected $fillable = [
        'title','image_path','image_thumb','is_distribution'
    ];

    //TODO : Model Relationship
    /*public function relPhotographyPackage(){
        return $this->belongsTo('App\PhotographyOptions', 'id', 'photography_package_id');
    }*/

    public function relPrintMaterial(){
        return $this->hasMany('App\PrintMaterialSize');
    }

}