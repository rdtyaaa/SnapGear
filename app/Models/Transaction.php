<?php

namespace App\Models;

use App\Models\User;
use App\Models\TransactionUnit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_code', 'user_id'];

    public function units()
    {
        return $this->hasMany(TransactionUnit::class, 'transaction_code', 'transaction_code');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'transaction_category', 'transaction_id', 'category_id');
    }
}

