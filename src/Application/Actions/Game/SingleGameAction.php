<?php

declare(strict_types=1);

namespace App\Application\Actions\Game;

use Psr\Http\Message\ResponseInterface as Response;

class SingleGameAction extends GameAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $gameId = (int) $this->resolveArg('id');
        $game = $this->gameRepository->getById($gameId);
        $this->logger->info("Game con id `${gameId}` inviato.");
        return $this->respondWithData($game);
    }
}
