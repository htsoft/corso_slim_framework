<?php

declare(strict_types=1);

namespace App\Domain\Game;

use JsonSerializable;

class Game implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $game_name;

    /**
     * @var int
     */
    private $game_active;

    /**
     * @param int|null  $id
     * @param string    $game_name
     * @param int       $game_active
     */
    public function __construct(?int $id, string $game_name, int $game_active)
    {
        $this->id = $id;
        $this->game_name = $game_name;
        $this->game_active = $game_active;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getGameName(): string
    {
        return $this->game_name;
    }

    /**
     * @return int
     */
    public function getGameActive(): int
    {
        return $this->game_active;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'game_name' => $this->game_name,
            'game_active' => $this->game_active,
        ];
    }
}
