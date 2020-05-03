<?php

namespace App\Infrastructure\Persistence\Leaderboard;

use App\Domain\Leaderboard\Leaderboard;
use App\Domain\Leaderboard\LeaderboardNotFoundException;
use App\Domain\Leaderboard\LeaderboardRepository;

use PDO;

class DBLeaderboardRepository implements LeaderboardRepository
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
    public function getAllForGameId(int $game_id): array
    {
        $retData = array();
        $query = "SELECT game_id, leaderboard_id, leaderboard_name, leaderboard_desc FROM leaderboards WHERE game_id=:game_id";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(array(":game_id" => $game_id));
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $leaderboard = new Leaderboard($row['game_id'], $row['leaderboard_id'], $row['leaderboard_name'], $row['leaderboard_desc']);
                $retData[] = $leaderboard;
            }
        }
        return $retData;
    }

    /**
     * {@inheritdoc}
     */
    public function getByGameIdAndLeadeboardId(int $game_id, int $leaderboard_id): Leaderboard
    {
        $leaderboard = null;
        $query = "SELECT game_id, leaderboard_id, leaderboard_name, leaderboard_desc FROM leaderboards WHERE game_id=:game_id AND leaderboard_id=:leaderboard_id";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(array(":game_id" => $game_id, ":leaderboard_id" => $leaderboard_id));
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $leaderboard = new Leaderboard($row['game_id'], $row['leaderboard_id'], $row['leaderboard_name'], $row['leaderboard_desc']);
        } else {
            throw new LeaderboardNotFoundException();
        }
        return $leaderboard;
    }
}
