<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Sync\Drivers\Session;
use Illuminate\Support\Collection;

class Cart
{
    public function __construct(protected Session $session)
    {
    }

    /**
     * * Adds an item to the active session.
     *
     * @param Product|null $product
     * @param array $options
     * @return void
     */
    public function add(?Product $product, array $options = []): void
    {
        $cartItem = $this->createCartItem($product, $options);

        $content = $this->session->get(config('cart.DEFAULT_INSTANCE'));

        if ($content->has($product->id)) {
            $cartItem->put('quantity', $content->get($product->id)->get('quantity') + 1);
        }

        $content->put($product->id, $cartItem);

        $this->session->store(config('cart.DEFAULT_INSTANCE'), $content->toArray());
    }


    public function remove(int $id): void
    {
        $content = $this->content();
        $this->session->put(config('cart.DEFAULT_INSTANCE'), $content->except($id));
    }

    public function clear()
    {

    }

    public function total(): string
    {
        $content = $this->content();

        $total = $content->reduce(function ($total, $item) {
            return $total += $item->get('price') * $item->get('quantity');
        });

        return number_format($total, 2);
    }

    public function content(): Collection
    {
        return is_null($this->session->get(config('cart.DEFAULT_INSTANCE'))) ? collect([]) : $this->session->get(config('cart.DEFAULT_INSTANCE'));
    }

    private function createCartItem(Product $product, array $options): Collection
    {
        return collect([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => 1,
            'options' => $options,
        ]);
    }

    public function id(): ?string
    {
        return $this->session->getId();
    }
}
