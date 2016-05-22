<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/22/16
 * Time: 11:29 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteLocalMedia extends Model
{
    protected $table='quote_local_media';

    protected $fillable=[
        'quote_id',
        'local_media_id',
        'local_media_option_id',
        'created_by',
        'updated_by',
    ];

}