<?php

declare(strict_types=1);

namespace App\Application\Actions\Score;

use Psr\Http\Message\ResponseInterface as Response;

class SingleScoreAction extends ScoreAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $gameId = (int) $this->resolveArg('gameid');
        $gameLb = (int) $this->resolveArg('gamelb');
        $userTag = (string) $this->resolveArg('usertag');
        $score = $this->scoreRepository->getUserScore($gameId, $gameLb, $userTag);
        $this->logger->info("Score con game_id `${gameId}` e gameLb `${gameLb}` e userTag `${userTag}` inviato.");
        return $this->respondWithData($score);
    }
}
