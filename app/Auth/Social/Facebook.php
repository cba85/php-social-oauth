<?php

namespace App\Auth\Social;

use App\Auth\Social\Contracts\ServiceInterface;
use stdClass;

class Facebook extends Service implements ServiceInterface
{
    public function __construct(\GuzzleHttp\Client $client, array $config)
    {
        parent::__construct($client, $config);
    }

    public function getAuthorizeCode(): string
    {
        $state = "facebook";
        return "{$this->config['authorizeUrl']}?client_id={$_ENV['FACEBOOK_CLIENT_ID']}&redirect_uri={$_ENV['APP_URL']}/home&state={$state}";
    }

    public function getAccessToken(string $code, string $state): string
    {
        try {
            $response = $this->client->get("{$this->config['accessTokenUrl']}", [
                'query' => [
                    'client_id' => $_ENV['FACEBOOK_CLIENT_ID'],
                    'client_secret' => $_ENV['FACEBOOK_CLIENT_SECRET'],
                    'code' => $code,
                    'state' => $state,
                    'redirect_uri' => "{$_ENV['APP_URL']}/home"
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
            'query' => [
                'access_token' => $token,
                'fields' => 'id,name,picture'
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
            'photo' => $user->picture->data->url
        ];
    }
}
