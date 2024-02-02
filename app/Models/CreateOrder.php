<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CreateOrder extends Order
{
    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    protected function prepareOrder(): string
    {

        $order = [
            "reference_id" => $this->referenceId,
            "customer" => $this->customer,
            "items" => $this->items,
            "shipping" => $this->shipping,
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ]
        ];

        if (isset($this->pix) && !empty($this->pix)) {
            $order["qr_codes"] = $this->pix;
        }

        if (isset($this->charges) && !empty($this->charges)) {
            $order["charges"] = $this->charges;
        }

        $order = json_encode($order);
        return $order;
    }


    public function createOrder()
    {
        try {
            $client = new Client();

            $response = $client->post($this->config->getBaseUrl() . '/orders', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->config->getToken(),
                    'Content-Type' => 'application/json',
                    "Accept: application/json",
                ],
                'body' => $this->prepareOrder()
            ]);

            $data = json_decode($response->getBody());

            return json_encode([
                'status' => $response->getStatusCode(),
                'data' => $data
            ]);
        } catch (RequestException $e) {

            return json_encode([
                'status' => $e->getCode(),
                'error' => $e->getMessage(),
            ]);

            return $e->getMessage();
        }
    }
}
