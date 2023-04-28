<?php

namespace App\Facades;

use App\Models\Product;

/**
 * * @method static \App\Services\Cart add(Product $product)
 * * @method static \App\Services\Cart remove(int $id)
 * * @method static \App\Services\Cart total()
 * * @method static \App\Services\Cart get()
 * * @method static \App\Services\Cart id()
 */
class Cart extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\Cart::class;
    }
}
