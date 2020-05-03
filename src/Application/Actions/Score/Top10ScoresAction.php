<?php

declare(strict_types=1);

namespace App\Application\Actions\Score;

use Psr\Http\Message\ResponseInterface as Response;

class Top10ScoresAction extends ScoreAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $gameId = (int) $this->resolveArg('gameid');
        $gameLb = (int) $this->resolveArg('gamelb');
        $scores = $this->scoreRepository->getTop10ForGameAndLeaderboard($gameId, $gameLb);
        $this->logger->info("Richiesta la top 10 degli scores per il gioco: `${gameId}` e la leaderboard: `${gameLb}`.");
        return $this->respondWithData($scores);
    }
}
