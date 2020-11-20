<?php

namespace App\Auth\Social;

class Service
{
    protected $client;
    protected $config;

    public function __construct(\GuzzleHttp\Client $client, array $config)
    {
        $this->client = $client;
        $this->config = $config;
    }
}
