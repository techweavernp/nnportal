<?php

namespace App\Models\FrontPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Menu extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $casts = [
        'is_active' => 'boolean',
        'menu_order' => 'integer',
    ];


    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('menu_order');
    }

    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function getMenuTypes(): array
    {
        return [
            'MM' => 'Main Menu',
            'FM' => 'Footer Menu',
        ];
    }
}
