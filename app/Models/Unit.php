<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'gambar', 'harga', 'stok'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_unit');
    }
}