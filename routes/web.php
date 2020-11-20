<?php

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->get('/', ([\App\Controllers\WelcomeController::class, 'index']));
    $r->get('/auth/github', ([\App\Controllers\AuthController::class, 'github']));
    $r->get('/auth/facebook', ([\App\Controllers\AuthController::class, 'facebook']));
    $r->get('/home', ([\App\Controllers\HomeController::class, 'index']));
});
