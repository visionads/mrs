<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MktgArtworkImage extends Model
{
    protected $table = 'mktg_artwork_image';

    protected $fillable = [
        'mktg_order_detail_id',
        'image',
    ];

    public function ArtworkImage(){
        return $this->belongsTo('App\MktgOrderDetail','mktg_order_detail_id','id');
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
