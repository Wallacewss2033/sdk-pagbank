<?php

namespace App\Models;

class Order
{
    protected string $referenceId;
    protected array $items, $shipping, $customer, $pix, $charges;

    public function setReferenceId(string $referenceId): void
    {
        $this->referenceId = $referenceId;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function setShipping(array $shipping): void
    {
        $this->shipping = $shipping;
    }

    public function setCustomer(array $customer): void
    {
        $this->customer = $customer;
    }

    public function setPix(array $pix): void
    {
        $this->pix = $pix;
    }

    public function setCharges(array $charges): void
    {
        $this->charges = $charges;
    }
}
