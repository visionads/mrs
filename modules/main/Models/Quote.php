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
        'print_material_comments',
        'print_material_distribution',
        'quote_number',
        'digital_media_id',
        'digital_media_note',
        'local_media_id',
        'local_media_option_id',
        'local_media_note'

    ];
}

