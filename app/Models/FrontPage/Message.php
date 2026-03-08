<?php

namespace App\Models\FrontPage;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'is_read' => 'boolean',
    ];
}
