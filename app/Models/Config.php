<?php

namespace App\Models;

class Config
{
    protected string $baseUrl = "https://sandbox.api.pagseguro.com";
    private string $token, $email;

    public function __construct(string $email, string $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}
