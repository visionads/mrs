<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 7/18/16
 * Time: 2:59 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class MktgSetting extends Model
{
    protected $table='mktg_settings';

    protected $fillable=[
        'type',
        'code',
        'last_number',
        'increment',
        'status',
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