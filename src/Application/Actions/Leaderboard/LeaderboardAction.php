<?php

declare(strict_types=1);

namespace App\Application\Actions\Leaderboard;

use App\Application\Actions\Action;
use App\Domain\Leaderboard\LeaderboardRepository;
use Psr\Log\LoggerInterface;

abstract class LeaderboardAction extends Action
{
    /**
     * @var LeaderboardRepository
     */
    protected $leaderboardRepository;

    /**
     * @param LoggerInterface $logger
     * @param LeaderboardRepository  $leaderboardRepository
     */
    public function __construct(LoggerInterface $logger, LeaderboardRepository $leaderboardRepository)
    {
        parent::__construct($logger);
        $this->leaderboardRepository = $leaderboardRepository;
    }
}
