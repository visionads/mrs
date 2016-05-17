<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/9/16
 * Time: 4:27 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PrintMaterialSize extends Model
{
    protected $table = 'print_material_size';

    protected $fillable = [
        'print_material_id','title','price','description'
    ];
}