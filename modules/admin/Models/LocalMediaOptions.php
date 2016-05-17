<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class LocalMediaOptions extends Model
{

    protected $table = 'local_media_option';

    protected $fillable = [
        'local_media_id',
        'title',
        'price'
    ];

}