<?php

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

require __DIR__ . '/../routes/web.php';
require __DIR__ . '/../app/router.php';
