<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/15/16
 * Time: 4:45 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;



class PropertyDetail extends Model
{
    protected $table = 'property_detail';

    protected $fillable = [
        'owner_name','address','vendor_name','vendor_email','vendor_phone','vendor_signature_path',
        'signature_date','agent_signature_path','main_selling_line','property_description',
        'inspection_features','	inspection_date','other_features','selling_price','auction_time','offer','note','business_id'
    ];

    public function quote()
    {
        return $this->belongsTo('App\Quote','id','property_type_id');
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