<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MktgOrder extends Model
{
    protected $table = 'mktg_order';

    protected $fillable = [
        'order_no',
        'date',
        'user_id',
        'amount',
        'gst',
        'total_amount',
        'status',
    ];

    public function relMktgOrderDetail(){
        return $this->hasMany('App\MktgOrderDetail');
    }

    public function relMktgInvoice(){
        return $this->hasOne('App\MktgInvoice');
    }


    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'

    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
            }
        });
    }
}
