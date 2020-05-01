<?php

declare(strict_types=1);

namespace App\Domain\Game;

interface GameRepository
{

    /**
     * @return Game[]
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return Game
     * @throws GameNotFoundException
     */
    public function getById(int $id): Game;
}
