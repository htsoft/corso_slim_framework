<?php

declare(strict_types=1);

namespace App\Domain\Game;

use App\Domain\DomainException\DomainRecordNotFoundException;

class GameNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The requested game was not found.';
}
