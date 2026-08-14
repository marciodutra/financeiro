<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome',
        'tipo',
        'saldo_inicial',
        'ativa',
    ];

    protected $casts = [
        'saldo_inicial' => 'decimal:2',
        'ativa' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}