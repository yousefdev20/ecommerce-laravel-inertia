<?php

namespace App\Services\Sync\Contracts;

interface Storable
{
    public function get(string $key);

    public function store(string $key, array $data);

    public function delete();
}
