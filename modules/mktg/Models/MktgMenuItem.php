<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MktgMenuItem extends Model
{
    protected $table = 'mktg_menu_item';

    protected $fillable = [
        'mktg_material_id',
        'title',
        'slug',
        'description',
        'status',
    ];

    public function relMktgMaterial(){
        return $this->belongsTo('App\MktgMaterial','mktg_material_id','id');
    }

    public function relMktgMenuItemImage(){
        return $this->hasMany('App\MktgMenuItemImage');
        //return $this->belongsTo('App\MktgMenuItemImage','mktg_menu_item_id','id');
    }

    public function relMktgItemOption(){
        return $this->hasMany('App\MktgItemOption')->orderBy('type','ASC');
    }

    public function relMktgMenuItemOrderdetails(){
        return $this->hasMany('App\MktgOrderDetail');
    }

    /*public function relMktgItemValue(){
        return $this->hasMany('App\MktgItemValue');
    }*/

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
