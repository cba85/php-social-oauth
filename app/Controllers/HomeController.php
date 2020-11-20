<?php

namespace App\Controllers;

use App\Auth\Social\{Github, Facebook, Service};
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function index(): void
    {
        if (empty($_GET['code'] or empty($_GET['state']))) {
            return;
        }

        if (($_GET['state'] == "github")) {
            $github = new Github(new Client, $this->config['github']);
            $user = $github->getUser($_GET['code'], $_GET['state']);
        } else {
            $facebook = new Facebook(new Client, $this->config['facebook']);
            $user = $facebook->getUser($_GET['code'], $_GET['state']);
        }

        $this->view('home', compact('user'));
    }
}
