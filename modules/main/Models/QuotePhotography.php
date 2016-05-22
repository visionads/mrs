<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/22/16
 * Time: 11:21 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class QuotePhotography extends Model
{
    protected $table='quote_photography';
    protected $fillable=[
        'quote_id',
        'photography_package_id',
        'created_by',
        'updated_by',
    ];
    public function relQuote(){
        return $this->belongsTo('App\Quote','quote_id','id');
    }
}