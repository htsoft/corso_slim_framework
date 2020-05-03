<?php

declare(strict_types=1);

use App\Domain\Game\GameRepository;
use App\Domain\Leaderboard\LeaderboardRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Game\DBGameRepository;
use App\Infrastructure\Persistence\Leaderboard\DBLeaderboardRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        GameRepository::class => \DI\autowire(DBGameRepository::class),
        LeaderboardRepository::class => \DI\autowire(DBLeaderboardRepository::class),
    ]);
};
