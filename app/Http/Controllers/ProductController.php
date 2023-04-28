<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = new ProductResource(Product::query()->simplePaginate(12));
        return Inertia::render('Shop/Products')->with(compact(['products']));
    }
}
