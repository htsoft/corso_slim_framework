<?php

declare(strict_types=1);

namespace App\Domain\Score;

use JsonSerializable;

class Score implements JsonSerializable
{
    /**
     * @var int
     */
    private $game_id;

    /**
     * @var int
     */
    private $game_lb;

    /**
     * @var string
     */
    private $user_tag;

    /**
     * @var int
     */
    private $score;

    /**
     * @var string
     */
    private $last_update;

    /**
     * @param int       $game_id
     * @param int       $game_lb
     * @param string    $user_tag
     * @param int       $score
     * @param string    $last_update
     */
    public function __construct(int $game_id, int $game_lb, string $user_tag, int $score, string $last_update)
    {
        $this->game_id = $game_id;
        $this->game_lb = $game_lb;
        $this->user_tag = $user_tag;
        $this->score = $score;
        $this->last_update = $last_update;
    }

    /**
     * @return int
     */
    public function getGameId(): int
    {
        return $this->game_id;
    }

    /**
     * @return int
     */
    public function getGameLb(): int
    {
        return $this->game_lb;
    }

    /**
     * @return string
     */
    public function getUserTag(): string
    {
        return $this->user_tag;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return string
     */
    public function getLastUpdate(): string
    {
        return $this->last_update;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'game_id' => $this->game_id,
            'game_lb' => $this->game_lb,
            'user_tag' => $this->user_tag,
            'score' => $this->score,
            'last_update' => $this->last_update,
        ];
    }
}
