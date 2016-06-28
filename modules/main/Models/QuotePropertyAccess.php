<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 6/28/16
 * Time: 3:27 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class QuotePropertyAccess extends Model
{
    protected $table='quote_property_access';

    protected $fillable=[
        'quote_id',
        'prefered_date',
        'property_access_options',
        'contact_name',
        'contact_number',
        'contact_alternate_number',
        'contact_email',
        'property_note',
        'created_by',
        'updated_by',
    ];
    public function relQuote(){
        return $this->belongsTo('App\Quote','quote_id','id');
    }



    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'

    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
                #$query->business_id = isset(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
                #$query->business_id = isset(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
    }

}