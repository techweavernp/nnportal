<?php

namespace App\Models\FrontPage;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $casts = [
        'info' => 'array'
    ];
}
