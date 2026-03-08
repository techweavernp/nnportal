<?php

namespace App\Models\FrontPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $casts = [
        'socials' => 'json',
    ];

    protected static function booted()
    {
        Cache::forget('TEAM');
        static::updating(function ($team) {
            if ($team->isDirty('image')) {
                Storage::disk('public')->delete('team/' . basename($team->getOriginal('image')));
            }
        });

        static::deleted(function ($team) {
            if ($team->image) {
                Storage::disk('public')->delete('team/' . basename($team->getOriginal('image')));
            }
        });
    }
}
