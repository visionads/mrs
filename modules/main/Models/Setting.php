<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/19/16
 * Time: 9:51 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table='sitting';

    protected $fillable=[
        'type',
        'last_number',
        'increment',
        'status',
        'created_by',
        'updated_by'
    ];

}