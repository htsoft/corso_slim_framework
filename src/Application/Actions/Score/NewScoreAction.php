<?php

declare(strict_types=1);

namespace App\Application\Actions\Score;

use Psr\Http\Message\ResponseInterface as Response;

class NewScoreAction extends ScoreAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->getFormData();
        $gameId = (int) $data->gameid;
        $gameLb = (int) $data->gamelb;
        $userTag = (string) $data->usertag;
        $score = (int) $data->score;
        $this->logger->info("Parametri inviati per lo score: `${gameId}` - `${gameLb}` - `${userTag}` - `${score}`");
        $scoreResult = $this->scoreRepository->setUserScore($gameId, $gameLb, $userTag, $score);
        $this->logger->info("Aggiornato lo score con game_id `${gameId}` e gameLb `${gameLb}` e userTag `${userTag}` e score `${score}` inviato.");
        return $this->respondWithData($scoreResult);
    }
}
