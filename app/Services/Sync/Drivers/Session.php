<?php

namespace App\Services\Sync\Drivers;

use App\Models\Product;
use App\Services\Sync\Contracts\Storable;
use Illuminate\Support\Facades\Session as SessionManager;
use Illuminate\Support\Collection;

class Session implements Storable
{
    protected array $data;

    public function data(array $data): Storable
    {
        $this->data = $data;
        return $this;
    }

    public function get(string $key): Collection
    {
        return is_null(SessionManager::get(config('cart.DEFAULT_INSTANCE'))) ? collect([]) : SessionManager::get(config('cart.DEFAULT_INSTANCE'));
    }

    public function store(string $key, array $data)
    {
        $content = $this->get();
        $cartItem = collect($data);
        if ($content->has($data['id'])) {
            $cartItem->put('quantity', $content->get($data['id'])->get('quantity') + $data['quantity']);
        }

        $content->put($data['id'], $cartItem);

        SessionManager::put(config('cart.DEFAULT_INSTANCE'), $content);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function id(): string
    {
        return SessionManager::getId();
    }
}
