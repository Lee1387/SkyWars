<?php

declare(strict_types=1);

namespace Lee1387\Session\Scoreboard\Layout;

use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class GameLayout implements Layout 
{

    public function getMessageContainer(Session $session): MessageContainer 
    {
        $game = $session->getGame();

        return new MessageContainer("GAME_SCOREBOARD", [
            "date" => date("d/m/y"),
            "players_count" => $game->getPlayersCount(),
            "kills" => $session->getStatistics()->getKills(null),
            "map" => $game->getMap()->getName(),
            "mode" => $game->getDifficulty()->getDisplayName(),
        ]);
    }
    
}