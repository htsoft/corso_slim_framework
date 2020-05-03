<?php

declare(strict_types=1);

namespace App\Domain\Leaderboard;

use App\Domain\DomainException\DomainRecordNotFoundException;

class LeaderboardNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The requested leaderboard was not found.';
}
