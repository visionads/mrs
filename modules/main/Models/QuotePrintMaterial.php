<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/22/16
 * Time: 11:26 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotePrintMaterial extends Model
{
    protected $table='quote_print_material';

    protected $fillable=[
        'quote_id',
        'print_material_id',
        'is_distributed',
        'print_material_size_id',
        'created_by',
        'updated_by',
    ];

}