<?php

declare(strict_types=1);

use App\Domain\Game\GameRepository;
use App\Domain\Leaderboard\LeaderboardRepository;
use App\Domain\Score\ScoreRepository;
use App\Infrastructure\Persistence\Game\DBGameRepository;
use App\Infrastructure\Persistence\Leaderboard\DBLeaderboardRepository;
use App\Infrastructure\Persistence\Score\DBScoreRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        GameRepository::class => \DI\autowire(DBGameRepository::class),
        LeaderboardRepository::class => \DI\autowire(DBLeaderboardRepository::class),
        ScoreRepository::class => \DI\autowire(DBScoreRepository::class),
    ]);
};
