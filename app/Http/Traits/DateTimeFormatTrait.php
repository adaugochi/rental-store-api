<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait DateTimeFormatTrait
{
    public function getCreatedAtAttribute(): string
    {
        $createdAt = Carbon::parse($this->attributes['created_at']);
        return $createdAt->format('M d, Y G:i A');
    }

    public function getUpdatedAtAttribute(): string
    {
        $createdAt = Carbon::parse($this->attributes['updated_at']);
        return $createdAt->format('M d, Y G:i A');
    }
}
