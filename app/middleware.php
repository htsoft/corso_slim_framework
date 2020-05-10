<?php

declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Slim\App;
use Tuupola\Middleware\JwtAuthentication;

return function (App $app) {
    $app->add(SessionMiddleware::class);

    // Aggiunta del plugin per la gestione del token JWT
    $app->add(new JwtAuthentication([
        "secure" => true,
        "secret" => "corsoslimtokenjwtauthentication",
        "path" => "/services/public/scores",
    ]));
};
