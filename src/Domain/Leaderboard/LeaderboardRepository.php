<?php

declare(strict_types=1);

namespace App\Domain\Leaderboard;

interface LeaderboardRepository
{

    /**
     * @param int $game_id
     * @return Leaderboard[]
     */
    public function getAllForGameId(int $game_id): array;

    /**
     * @param int $game_id
     * @param int $leaderboard_id
     * @return Leaderboard
     * @throws LeaderboardNotFoundException
     */
    public function getByGameIdAndLeadeboardId(int $game_id, int $leaderboard_id): Leaderboard;
}
