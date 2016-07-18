<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MktgInvoice extends Model
{
    protected $table = 'mktg_invoice';

    protected $fillable = [
        'mktg_order_id',
        'invoice_type',
        'invoice_no',
        'date',
        'amount',
        'reference',
        'status',
    ];

    public function relMktgOrder(){
        return $this->belongsTo('App\MktgOrder','mktg_order_id','id');
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
