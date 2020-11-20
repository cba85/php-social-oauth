<?php

namespace App\Auth\Social\Contracts;

use stdClass;

interface ServiceInterface
{
    public function getAuthorizeCode(): string;
    public function getAccessToken(string $code, string $state): string;
    public function getUser(string $code, string $state): stdClass;
    public function normalize(stdClass $user): stdClass;
}
