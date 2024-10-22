<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'gambar'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}