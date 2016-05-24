<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/18/16
 * Time: 4:13 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class PrintMaterialDistribution extends Model
{
    protected $table='print_material_distribution';
    protected $fillable=[
        'quantity',
        'is_surrounded',
        'other_address',
        'date_of_distribution',
        'note',
        'created_by',
        'updated_by',
    ];

    public function quote(){
        return $this->belongsTo('App\Quote','id','print_material_distribution_id');
    }
}