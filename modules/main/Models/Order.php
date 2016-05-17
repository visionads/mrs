<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Order extends Model
{

    protected $table = 'property_detail';

    protected $fillable = [
            'main_selling_line',
    ];

}