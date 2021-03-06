<?php

declare(strict_types=1);

namespace App\Application\Actions\Score;

use Psr\Http\Message\ResponseInterface as Response;

class ListScoresAction extends ScoreAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $token = $this->request->getAttribute("token");
        $datiToken = $token['data'];
        $this->logger->info("Il parametro passato nel token è: `${datiToken}`");
        $gameId = (int) $this->resolveArg('gameid');
        $gameLb = (int) $this->resolveArg('gamelb');
        $scores = $this->scoreRepository->getAllForGameAndLeaderboard($gameId, $gameLb);
        $this->logger->info("Richiesta la lista completa degli scores per il gioco: `${gameId}` e la leaderboard: `${gameLb}`.");
        return $this->respondWithData($scores);
    }
}
