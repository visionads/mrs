<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MktgMenuItemImage extends Model
{
    protected $table = 'mktg_menu_item_img';

    protected $fillable = [
        'mktg_menu_item_id',
        'image',
    ];

    public function relMktMenuItem(){
        return $this->belongsTo('App\MktgMenuItem','mktg_menu_item_id','id');
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
