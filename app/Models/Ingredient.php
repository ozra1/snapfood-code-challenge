<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'best_before', 'expires_at', 'stock',
    ];

    public function foods()
    {
        return $this->belongsToMany(Food::class);
    }
}
