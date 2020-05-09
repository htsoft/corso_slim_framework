<?php

declare(strict_types=1);

use App\Application\Actions\Game\ListGamesAction;
use App\Application\Actions\Game\SingleGameAction;
use App\Application\Actions\Leaderboard\ListLeaderboardsAction;
use App\Application\Actions\Leaderboard\SingleLeaderboardAction;
use App\Application\Actions\Score\ListScoresAction;
use App\Application\Actions\Score\NewScoreAction;
use App\Application\Actions\Score\Top10ScoresAction;
use App\Application\Actions\User\LoginAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->post('/login', LoginAction::class);

    $app->group('/games', function (Group $group) {
        $group->get('', ListGamesAction::class);
        $group->get('/{id}', SingleGameAction::class);
    });

    $app->group('/leaderboards', function (Group $group) {
        $group->get('/{gameid}', ListLeaderboardsAction::class);
        $group->get('/{gameid}/{leaderboardid}', SingleLeaderboardAction::class);
    });

    $app->group('/scores', function (Group $group) {
        $group->get('/list/{gameid}/{gamelb}', ListScoresAction::class);
        $group->get('/top10/{gameid}/{gamelb}', Top10ScoresAction::class);
        $group->get('/single/{gameid}/{gamelb}/{usertag}', SingleLeaderboardAction::class);
        $group->post('/new', NewScoreAction::class);
    });
};
