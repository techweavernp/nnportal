<?php

namespace App\Models;

use App\Enums\PaymentModeEnum;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdCampaign extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'is_active' => 'boolean',
            'payment_amount' => 'double',
            'is_paid' => 'boolean',
            'payment_date' => 'datetime',
            'payment_mode' => PaymentModeEnum::class,
        ];
    }

    public function adList(): BelongsTo
    {
        return $this->belongsTo(AdList::class, 'ad_list_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /*
     * Below are local scopes
     */
    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('is_active', true);
    }
}
