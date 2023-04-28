<?php

namespace App\Listeners;

use App\Facades\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MigrateSessionCartToDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $cart = Cart::get();

        if (count((array)$cart) > 0) {
            if (auth()->user()->cart()->active()->count() <= 0) {
                $databaseCart = auth()->user()->cart()->create(['session_id' => Cart::id()]);
            }else {
                $databaseCart = auth()->user()->cart()->active()->first();
            }
            $products = auth()->user()->cart()->first()->products();
            foreach (Cart::get() as $item) {
                $products->attach(
                    ['product_id' => $item['id']],
                    ['product_id' => $item['id'],'quantity' => 10]
                );
            }
        }
    }
}
