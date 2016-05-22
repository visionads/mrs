<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/22/16
 * Time: 11:23 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class QuoteSignboard extends Model
{
    protected $table='quote_signboard';

    protected $fillable=[
        'quote_id',
        'signboard_package_id',
        'signboard_size_id',
        'created_by',
        'updated_by',
    ];
    public function relQuote(){
        return $this->belongsTo('App\Quote','quote_id','id');
    }
}