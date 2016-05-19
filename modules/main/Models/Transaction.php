<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/19/2016
 * Time: 12:25 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = [
         'quote_id',
         'invoice_no',
         'amount',
         'gst',
         'total_amount',
         'status'
    ];
}