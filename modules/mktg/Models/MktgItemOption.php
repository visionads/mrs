<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MktgItemOption extends Model
{
    protected $table = 'mktg_item_option';

    protected $fillable = [
        'mktg_menu_item_id',
        'type',
        'title',
        'slug',
        'image',
        'status',
    ];

    public function relMktgMenuItem(){
        return $this->belongsTo('App\MktgMenuItem','mktg_menu_item_id','id');
    }

    public function relMktgItemValue(){
        return $this->hasMany('App\MktgItemValue');
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
