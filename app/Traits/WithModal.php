<?php

namespace App\Traits;

trait WithModal
{
    public function modal($method, $modal)
    {
        $this->dispatchBrowserEvent('modal', ['method' => $method, 'name' => $modal]);
    }
}