<?php

declare(strict_types=1);

namespace App\Application\Actions\Leaderboard;

use Psr\Http\Message\ResponseInterface as Response;

class ListLeaderboardsAction extends LeaderboardAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $gameId = (int) $this->resolveArg('gameid');
        $leaderboards = $this->leaderboardRepository->getAllForGameId($gameId);
        $this->logger->info("Richiesta la lista completa delle leaderboards per il gioco: `${gameId}`.");
        return $this->respondWithData($leaderboards);
    }
}
