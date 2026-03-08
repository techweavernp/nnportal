<?php

namespace App\Models\FrontPage;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $casts = [
        'counter' => 'json',
    ];
}
