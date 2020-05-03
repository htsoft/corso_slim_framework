<?php

declare(strict_types=1);

namespace App\Domain\Score;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ScoreNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The requested score was not found.';
}
