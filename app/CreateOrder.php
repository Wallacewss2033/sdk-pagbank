<?php

namespace App;

use App\Models\Config;
use App\Models\Order;
use App\Services\OrderService;

class CreateOrder extends Order
{
    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function handlerCreate()
    {
        $orderService = new OrderService();
        $order = $orderService->prepare([
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
