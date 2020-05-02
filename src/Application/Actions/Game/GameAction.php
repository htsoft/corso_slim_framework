<?php

declare(strict_types=1);

namespace App\Application\Actions\Game;

use App\Application\Actions\Action;
use App\Domain\Game\GameRepository;
use Psr\Log\LoggerInterface;

abstract class GameAction extends Action
{
    /**
     * @var GameRepository
     */
    protected $gameRepository;

    /**
     * @param LoggerInterface $logger
     * @param GameRepository  $gameRepository
     */
    public function __construct(LoggerInterface $logger, GameRepository $gameRepository)
    {
        parent::__construct($logger);
        $this->gameRepository = $gameRepository;
    }
}
