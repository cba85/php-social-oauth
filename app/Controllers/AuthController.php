<?php

namespace App\Controllers;

use App\Auth\Social\{Facebook, Github, Google};
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function github(): void
    {
        $github = new Github(new Client, $this->config->get('github'));
        header("Location: {$github->getAuthorizeCode()}");
    }

    public function facebook(): void
    {
        $facebook = new Facebook(new Client, $this->config->get('facebook'));
        header("Location: {$facebook->getAuthorizeCode()}");
    }
}
