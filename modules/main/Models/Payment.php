<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/19/2016
 * Time: 12:29 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    protected $fillable = [
        'transaction_id',
        'payment_trans',
        'type',
        'amount',
        'status'
    ];

    public function relTransaction(){
        return $this->belongsTo('App\Transaction','transaction_id','id');
    }
}