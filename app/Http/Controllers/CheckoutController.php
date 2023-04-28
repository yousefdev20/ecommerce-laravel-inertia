<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function index(): \Inertia\Response
    {
        $total = Cart::total();
        return Inertia::render('Shop/Checkout')->with([compact(['total'])]);
    }
}
