<?php

namespace App\Services\Sync;

use App\Services\Sync\Contracts\Runnable;
use App\Services\Sync\Contracts\Storable;

class Syncing implements Runnable
{
    public function __construct(protected Storable $storable)
    {
    }

    public function data(array $data): Storable
    {
        $this->storable->data($data);
        return $this->storable;
    }

    public function run(): void
    {
        $this->storable->store();
    }
}
