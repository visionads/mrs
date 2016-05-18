<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/17/2016
 * Time: 2:22 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Quote extends Model
{
    protected $table = 'quote';

    protected $fillable = [
        'solution_type_id',
        'property_detail_id',
        'photography_package_id',
        'photography_package_comments',
        'signboard_package_id',
        'signboard_package_size_id',
        'signboard_package_comments',
        'print_material_id',
        'is_distributed',
        'print_material_size_id',
        'print_material_comments',
        'print_material_distribution_id',
        'quote_number',
        'digital_media_id',
        'digital_media_note',
        'local_media_id',
        'local_media_option_id',
        'local_media_note'

    ];

    public function solution_type(){
        return $this->hasOne('App\SolutionType','id','solution_type_id');
    }
    public function property_detail(){
        return $this->hasOne('App\PropertyDetail','id','property_detail_id');
    }
    public function print_material_distribution(){
        return $this->hasOne('App\PrintMaterialDistribution','id','print_material_distribution_id');
    }
}

