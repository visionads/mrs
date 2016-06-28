<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/28/16
 * Time: 3:27 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class QuotePropertyImage extends Model
{
    protected $table='quote_property_image';

    protected $fillable=[
        'quote_property_access_id',
        'image_path',
    ];
    public function relPropertyAccess(){
        return $this->belongsTo('App\QuotePropertyAccess','quote_property_access_id','id');
    }



    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'

    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
                #$query->business_id = isset(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
                #$query->business_id = isset(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
    }

}