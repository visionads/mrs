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

class PrintMaterialSize extends Model
{
    protected $table = 'print_material_size';

    protected $fillable = [
        'print_material_id','title','price','description','business_id','image','image_thumb'
    ];



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