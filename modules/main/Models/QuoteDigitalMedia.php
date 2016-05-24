<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/22/16
 * Time: 11:28 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteDigitalMedia extends Model
{
    protected $table='quote_digital_media';

    protected $fillable=[
        'quote_id',
        'digital_media_id',
        'created_by',
        'updated_by',
    ];
    public function relQuote(){
        return $this->belongsTo('App\Quote','quote_id','id');
    }

}