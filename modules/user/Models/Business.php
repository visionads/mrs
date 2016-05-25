<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 2/15/16
 * Time: 11:41 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;


class Business extends Model
{

    protected $table = 'business';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','slug','address', 'status'
    ];

}