<?php

declare(strict_types=1);

namespace App\Domain\Score;

interface ScoreRepository
{

    /**
     * @param int $game_id
     * @param int $game_lb
     * @return Score[]
     */
    public function getAllForGameAndLeaderboard(int $game_id, int $game_lb): array;

    /**
     * @param int $game_id
     * @param int $game_lb
     * @return Score[]
     */
    public function getTop10ForGameAndLeaderboard(int $game_id, int $game_lb): array;

    /**
     * @param int $game_id
     * @param int $game_lb
     * @param string $user_tag
     * @return Score
     * @throws ScoreNotFoundException
     */
    public function getUserScore(int $game_id, int $game_lb, string $user_tag): Score;

    /**
     * @param int $game_id
     * @param int $game_lb
     * @param string $user_tag
     * @param int $score
     * @return Score
     * @throws ScoreRecordInsertErrorException
     */
    public function setUserScore(int $game_id, int $game_lb, string $user_tag, int $score): Score;
}
