<?php

namespace App;

use App\Models\Config;
use App\Models\Order;
use App\Services\OrderService;

class CreateOrder extends Order
{
    protected Config $config;
    protected OrderService $orderService;

    public function __construct(Config $config, OrderService $orderService)
    {
        $this->config = $config;
        $this->orderService = $orderService;
    }

    public function handlerCreate()
    {
        $order = $this->orderService->prepare([
            'referenceId' => $this->referenceId,
            'items' => $this->items,
            'shipping' => $this->shipping,
            'customer' => $this->customer,
            'pix' => $this->pix ?? [],
            'charges' => $this->charges ?? []
        ]);
        return $this->orderService->create($this->config, $order);
    }
}
