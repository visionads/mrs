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

    public function MktMaterial(){
        return $this->belongsTo('App\MktgMaterial','mktg_material_id','id');
    }

    public function relMktgMenuItem(){
        return $this->hasMany('App\MktgMenuItemImage');
    }

    public function relMktgMenuOption(){
        return $this->hasMany('App\MktgItemOption');
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
