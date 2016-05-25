<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/18/16
 * Time: 4:13 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class PrintMaterialDistribution extends Model
{
    protected $table='print_material_distribution';
    protected $fillable=[
        'quantity',
        'is_surrounded',
        'other_address',
        'date_of_distribution',
        'note',
        'business_id',
        'created_by',
        'updated_by',
    ];

    public function quote(){
        return $this->belongsTo('App\Quote','id','print_material_distribution_id');
    }


    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'

    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
                $query->business_id = iseet(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
                $query->business_id = iseet(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
    }
}