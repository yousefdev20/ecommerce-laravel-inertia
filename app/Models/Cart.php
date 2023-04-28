<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id', 'status'];

    // -------------------Relationships ----------------------//
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'cart_products');
    }

    // -------------------Local Scopes ----------------------//
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 1);
    }
}
