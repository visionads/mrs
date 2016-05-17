<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/8/16
 * Time: 1:40 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class PhotographyOptions extends Model
{
    protected $table = 'photography_options';

    protected $fillable = [
        'photography_package_id','items','description'
    ];

}