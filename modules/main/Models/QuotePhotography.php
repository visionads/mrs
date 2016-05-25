<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/22/16
 * Time: 11:21 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class QuotePhotography extends Model
{
    protected $table='quote_photography';
    protected $fillable=[
        'quote_id',
        'photography_package_id',
        'business_id',
        'created_by',
        'updated_by',
    ];
    public function relQuote(){
        return $this->belongsTo('App\Quote','quote_id','id');
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