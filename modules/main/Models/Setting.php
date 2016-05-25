<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/19/16
 * Time: 9:51 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table='setting';

    protected $fillable=[
        'type',
        'last_number',
        'increment',
        'status',
        'business_id',
        'created_by',
        'updated_by'
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