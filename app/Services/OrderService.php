<?php

namespace App\Services;

use App\Models\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class OrderService
{
    public function prepare(array $data)
    {
        $order = [
            "reference_id" => $data["referenceId"],
            "customer" => $data["customer"],
            "items" => $data["items"],
            "shipping" => $data["shipping"],
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ]
        ];

        if (isset($data["pix"]) && !empty($data["pix"])) {
            $order["qr_codes"] = $data["pix"];
        }

        if (isset($data["charges"]) && !empty($data["charges"])) {
            $order["charges"] = $data["charges"];
        }

        $order = json_encode($order);
        return $order;
    }

    public function create(Config $config, $order)
    {
        try {
            $client = new Client();

            $response = $client->post($config->getBaseUrl() . '/orders', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $config->getToken(),
                    'Content-Type' => 'application/json',
                    "Accept: application/json",
                ],
                'body' => $order
            ]);

            $data = json_decode($response->getBody());
            return $data;
        } catch (RequestException $e) {
            return $e->getMessage();
        }
    }
}
