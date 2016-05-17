<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/10/16
 * Time: 2:18 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class SignboardPackageSize extends Model
{
    protected $table = 'signboard_package_size';

    protected $fillable = [
        'signboard_package_id','title','price','description'
    ];

}