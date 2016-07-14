<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MktgItemValue extends Model
{
    protected $table = 'mktg_item_value';

    protected $fillable = [
        'mktg_item_option_id',
        'title',
        'slug',
        'price',
        'image',
        'status',
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
