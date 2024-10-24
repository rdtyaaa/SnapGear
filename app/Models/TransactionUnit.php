<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionUnit extends Model
{
    protected $fillable = [
        'transaction_code', 'unit_id', 'date_borrowed', 'return_agreement', 'date_returned', 'price', 'fine', 'status'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_code', 'transaction_code');
    }

    // Relasi ke model Unit
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
