<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MktgOrderDetail extends Model
{
    protected $table = 'mktg_order_detail';

    protected $fillable = [
        'mktg_order_id',
        'mktg_item_value_id',
        'amount',
        'mktg_artwork_id',
        'artwork_comment',
        'artwork_amount',
        'total_amount',
    ];


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