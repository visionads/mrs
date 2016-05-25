<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/19/2016
 * Time: 12:29 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    protected $fillable = [
        'transaction_id',
        'payment_trans',
        'type',
        'amount',
        'status',
        'business_id'
    ];

    public function relTransaction(){
        return $this->belongsTo('App\Transaction','transaction_id','id');
    }

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