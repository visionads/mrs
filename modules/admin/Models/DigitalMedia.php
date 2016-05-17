<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class DigitalMedia extends Model
{

    protected $table = 'digital_media';

    protected $fillable = [
        'title',
        'url'
    ];

}