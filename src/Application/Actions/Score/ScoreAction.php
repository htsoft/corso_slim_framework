<?php

declare(strict_types=1);

namespace App\Application\Actions\Score;

use App\Application\Actions\Action;
use App\Domain\Score\ScoreRepository;
use Psr\Log\LoggerInterface;

abstract class ScoreAction extends Action
{
    /**
     * @var ScoreRepository
     */
    protected $scoreRepository;

    /**
     * @param LoggerInterface $logger
     * @param ScoreRepository  $scoreRepository
     */
    public function __construct(LoggerInterface $logger, ScoreRepository $scoreRepository)
    {
        parent::__construct($logger);
        $this->scoreRepository = $scoreRepository;
    }
}
