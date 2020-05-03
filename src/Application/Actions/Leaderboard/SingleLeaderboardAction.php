<?php

declare(strict_types=1);

namespace App\Application\Actions\Leaderboard;

use Psr\Http\Message\ResponseInterface as Response;

class SingleLeaderboardAction extends LeaderboardAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $gameId = (int) $this->resolveArg('gameid');
        $leaderboardId = (int) $this->resolveArg('leaderboardid');
        $leaderboard = $this->leaderboardRepository->getByGameIdAndLeadeboardId($gameId, $leaderboardId);
        $this->logger->info("Leaderboard con game_id `${gameId}` e leaderboard_id `${leaderboardId}` inviato.");
        return $this->respondWithData($leaderboard);
    }
}
