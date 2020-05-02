<?php

declare(strict_types=1);

namespace App\Application\Actions\Game;

use Psr\Http\Message\ResponseInterface as Response;

class ListGamesAction extends GameAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $games = $this->gameRepository->getAll();
        $this->logger->info("Richiesta la lista completa dei games.");
        return $this->respondWithData($games);
    }
}
