<?php

namespace App\Services\Sync\Drivers;

use App\Services\Sync\Contracts\Runnable;
use App\Services\Sync\Contracts\Storable;

class Database implements Storable, Runnable
{
    protected array $data;

    public function run(): void
    {
        // TODO: Implement run() method.
    }

    public function data(array $data): Storable
    {
        $this->data = $data;
        return $this;
    }
}
