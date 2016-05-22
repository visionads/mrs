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

    public function relSolutionType(){
        return $this->hasOne('App\SolutionType','id','solution_type_id');
    }
    public function relPropertyDetail(){
        return $this->hasOne('App\PropertyDetail','id','property_detail_id');
    }
    public function relPrintMaterialDistribution(){
        return $this->hasOne('App\PrintMaterialDistribution','id','print_material_distribution_id');
    }
    public function relQuotePhotography(){
        return $this->hasMany('App\QuotePhotography','quote_id','id');
    }
    public function relQuoteSignboard(){
        return $this->hasMany('App\QuoteSignboard','quote_id','id');
    }
    public function relQuotePrintMaterial(){
        return $this->hasMany('App\QuotePrintMaterial','quote_id','id');
    }
    public function relQuoteDigitalMedia(){
        return $this->hasMany('App\QuoteDigitalMedia','quote_id','id');
    }
    public function relQuoteLocalMedia(){
        return $this->hasMany('App\QuoteLocalMedia','quote_id','id');
    }
}

