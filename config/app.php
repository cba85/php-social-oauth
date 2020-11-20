<?php

return [
    'github' => [
        'authorizeUrl' => "https://github.com/login/oauth/authorize",
        'accessTokenUrl' => "https://github.com/login/oauth/access_token",
        'userUrl' => "https://api.github.com/user"
    ],
    'facebook' => [
        'authorizeUrl' => "https://www.facebook.com/v9.0/dialog/oauth",
        'accessTokenUrl' => "https://graph.facebook.com/v9.0/oauth/access_token",
        'userUrl' => "https://graph.facebook.com/v9.0/me"
    ],
];
