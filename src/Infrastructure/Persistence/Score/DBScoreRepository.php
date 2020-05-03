<?php

namespace App\Infrastructure\Persistence\Score;

use App\Domain\Score\Score;
use App\Domain\Score\ScoreNotFoundException;
use App\Domain\Score\ScoreRecordInsertErrorException;
use App\Domain\Score\ScoreRepository;
use Exception;
use PDO;

class DBScoreRepository implements ScoreRepository
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
    public function getAllForGameAndLeaderboard(int $game_id, int $game_lb): array
    {
        $retData = array();
        $query = "SELECT game_id, game_lb, user_tag, score, last_update FROM scores WHERE game_id=:game_id AND game_lb=:game_lb ORDER BY score DESC";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(array(":game_id" => $game_id, ":game_lb" => $game_lb));
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $score = new Score($row['game_id'], $row['game_lb'], $row['user_tag'], $row['score'], $row["last_update"]);
                $retData[] = $score;
            }
        }

        return $retData;
    }

    /**
     * {@inheritdoc}
     */
    public function getTop10ForGameAndLeaderboard(int $game_id, int $game_lb): array
    {
        $retData = array();
        $query = "SELECT game_id, game_lb, user_tag, score, last_update FROM scores WHERE game_id=:game_id AND game_lb=:game_lb ORDER BY score DESC LIMIT 0,10";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(array(":game_id" => $game_id, ":game_lb" => $game_lb));
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $score = new Score($row['game_id'], $row['game_lb'], $row['user_tag'], $row['score'], $row["last_update"]);
                $retData[] = $score;
            }
        }

        return $retData;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserScore(int $game_id, int $game_lb, string $user_tag): Score
    {
        $score = null;
        $query = "SELECT game_id, game_lb, user_tag, score, last_update FROM scores WHERE game_id=:game_id AND game_lb=:game_lb AND user_tag=:user_tag";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(array(":game_id" => $game_id, ":game_lb" => $game_lb, ":user_tag" => $user_tag));
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $score = new Score($row['game_id'], $row['game_lb'], $row['user_tag'], $row['score'], $row["last_update"]);
        } else {
            throw new ScoreNotFoundException();
        }

        return $score;
    }

    /**
     * {@inheritdoc}
     */
    public function setUserScore(int $game_id, int $game_lb, string $user_tag, int $score): Score
    {
        $proceed = false;
        $resultScore = null;
        try {
            $resultScore = $this->getUserScore($game_id, $game_lb, $user_tag);
            if ($resultScore->getScore() < $score) {
                $proceed = true;
            }
        } catch (Exception $e) {
            $proceed = true;
        }
        if ($proceed) {
            $query = "INSERT INTO scores(game_id, game_lb, user_tag, score) VALUES(:game_id, :game_lb, :user_tag, :score) ON DUPLICATE KEY UPDATE score=:new_score";
            $stmt = $this->connection->prepare($query);
            $params = array(":game_id" => $game_id, ":game_lb" => $game_lb, ":user_tag" => $user_tag, ":score" => $score, ":new_score" => $score);
            if ($stmt->execute($params)) {
                $resultScore = $this->getUserScore($game_id, $game_lb, $user_tag);
            } else {
                throw new ScoreRecordInsertErrorException("Error details: " . implode(":", $stmt->errorInfo()));
            }
        }

        return $resultScore;
    }
}
