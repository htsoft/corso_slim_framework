<?php

namespace App\Infrastructure\Persistence\Game;

use App\Domain\Game\Game;
use App\Domain\Game\GameNotFoundException;
use App\Domain\Game\GameRepository;

use PDO;

class DBGameRepository implements GameRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * @param PDO   $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection
    }

    
}
