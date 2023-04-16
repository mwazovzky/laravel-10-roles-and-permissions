<?php

namespace App\Models;

use App\Enums\Transactions\Status;
use App\Enums\Transactions\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    protected $casts = [
        'type' => Type::class,
        'status' => Status::class,
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function confirm(): bool
    {
        return $this->update(['status' => Status::CONFIRMED]);
    }

    public function cancel(): bool
    {
        return $this->update(['status' => Status::CANCELLED]);
    }
}
