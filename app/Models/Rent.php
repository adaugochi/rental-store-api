<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rent extends Model
{
    use HasFactory;

    const RENTED = 'rented';
    const RETURNED = 'returned';
    const BOOKS = 'books';
    const EQUIPMENT = 'equipment';

    protected $fillable = [
        'id',
        'rent_type',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
