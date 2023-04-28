<?php

namespace App\Http\Controllers;

use App\Events\OrderConfirmation;
use App\Facades\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(): \Inertia\Response
    {
        $total = Cart::total();
        return Inertia::render('Shop/Cart')->with([compact(['total'])]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        Cart::add(Product::find($request->product['id']));
        return to_route('product.index');
    }

    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        Cart::remove($id);
        return to_route('cart.index');
    }
}
