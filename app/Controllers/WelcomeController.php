<?php

namespace App\Controllers;

class WelcomeController extends Controller
{
    public function index(): void
    {
        $this->view('welcome');
    }
}
