<?php

declare(strict_types=1);

namespace App\Domain\Score;

use App\Domain\DomainException\DomainRecordInsertErrorException;

class ScoreRecordInsertErrorException extends DomainRecordInsertErrorException
{
    public $message = 'Unable to insert or update the user score: ';

    public function __construct(string $errorInfo)
    {
        $this->message .= $errorInfo;
    }
}
