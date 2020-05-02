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
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(): array
    {
        $retData = array();
        $query = "SELECT id, game_name, game_active FROM games";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $game = new Game($row['id'], $row['game_name'], $row['game_active']);
                $retData[] = $game;
            }
        }
        return $retData;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): Game
    {
        $game = null;
        $query = "SELECT id, game_name, game_active FROM games WHERE id=:id";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(array(":id" => $id));
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $game = new Game($row['id'], $row['game_name'], $row['game_active']);
        } else {
            throw new GameNotFoundException();
        }
        return $game;
    }
}
