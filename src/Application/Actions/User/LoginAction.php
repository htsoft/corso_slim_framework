<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Domain\User\UserNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;

class LoginAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->getFormData();
        if (strcmp($data->user, "shima") == 0 && strcmp($data->pwd, "kaze") == 0) {
            $token = \Firebase\JWT\JWT::encode(["data" => random_int(1, 10000)], "corsoslimtokenjwtauthentication", 'HS256');
            return $this->respondWithData($token);
        } else {
            throw new UserNotFoundException();
        }
    }
}
