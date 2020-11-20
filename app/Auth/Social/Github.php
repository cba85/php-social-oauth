<?php

namespace App\Auth\Social;

use App\Auth\Social\Contracts\ServiceInterface;
use stdClass;

class Github extends Service implements ServiceInterface
{
    public function __construct(\GuzzleHttp\Client $client, array $config)
    {
        parent::__construct($client, $config);
    }

    public function getAuthorizeCode(): string
    {
        $state = "github";
        //$state = uniqid();
        return "{$this->config['authorizeUrl']}?client_id={$_ENV['GITHUB_CLIENT_ID']}&state={$state}";
    }

    public function getAccessToken(string $code, string $state): string
    {
        try {
            $response = $this->client->post($this->config['accessTokenUrl'], [
                'form_params' => [
                    'client_id' => $_ENV['GITHUB_CLIENT_ID'],
                    'client_secret' => $_ENV['GITHUB_CLIENT_SECRET'],
                    'code' => $code,
                    'state' => $state
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ]
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                echo $e->getResponse()->getBody()->getContents();
            }
            die();
        }
        $json = json_decode($response->getBody()->getContents());
        return $json->access_token;
    }

    public function getUser(string $code, string $state): stdClass
    {
        $token = $this->getAccessToken($code, $state);
        $response = $this->client->get($this->config['userUrl'], [
            'headers' => [
                'Authorization' => "token {$token}",
            ]
        ]);
        $user = json_decode($response->getBody()->getContents());
        return $this->normalize($user);
    }

    public function normalize(stdClass $user): stdClass
    {
        return (object) [
            'id' => $user->id,
            'name' => $user->name,
            'photo' => $user->avatar_url
        ];
    }
}
