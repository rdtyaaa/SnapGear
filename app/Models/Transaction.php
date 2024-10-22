<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'id_unit',
        'id_user',
        'borrow_date',
        'denda',
    ];

    // Relasi dengan model Unit
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

