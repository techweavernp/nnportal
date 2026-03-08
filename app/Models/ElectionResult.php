<?php

namespace App\Models;

use App\Helpers\NepaliDateConvertor;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ElectionResult extends Model
{
    protected $guarded = ['id'];

    protected function updatedAtHuman(): Attribute
    {
        return Attribute::get(fn () => NepaliDateConvertor::toHuman($this->updated_at));
    }
}
