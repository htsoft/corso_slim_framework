<?php

declare(strict_types=1);

namespace App\Domain\Leaderboard;

use JsonSerializable;

class Leaderboard implements JsonSerializable
{
    /**
     * @var int
     */
    private $game_id;

    /**
     * @var int|null
     */
    private $leaderboard_id;

    /**
     * @var string
     */
    private $leaderboard_name;

    /**
     * @var string
     */
    private $leaderboard_desc;

    /**
     * @param int       $game_id
     * @param int|null  $leaderboard_id
     * @param string    $leaderboard_name
     * @param string    $leaderboard_desc
     */
    public function __construct(int $game_id, ?int $leaderboard_id, string $leaderboard_name, string $leaderboard_desc)
    {
        $this->game_id = $game_id;
        $this->leaderboard_id = $leaderboard_id;
        $this->leaderboard_name = $leaderboard_name;
        $this->leaderboard_desc = $leaderboard_desc;
    }

    /**
     * @return int
     */
    public function getGameId(): int
    {
        return $this->game_id;
    }

    /**
     * @return int|null
     */
    public function getLeaderboardId(): ?int
    {
        return $this->leaderboard_id;
    }

    /**
     * @return string
     */
    public function getLeaderboardName(): string
    {
        return $this->leaderboard_name;
    }

    /**
     * @return string
     */
    public function getLeaderboardDesc(): string
    {
        return $this->leaderboard_desc;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'game_id' => $this->game_id,
            'leaderboard_id' => $this->leaderboard_id,
            'leaderboard_name' => $this->leaderboard_name,
            'leaderboard_desc' => $this->leaderboard_desc,
        ];
    }
}
