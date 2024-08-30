<?php

declare(strict_types=1);

namespace Lee1387\Session\Scoreboard\Layout;

use Lee1387\Game\Map\Mode;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class LobbyLayout implements Layout 
{

    public function getMessageContainer(Session $session): MessageContainer
    {
        $statistics = $session->getStatistics();

        return new MessageContainer("LOBBY_SCOREBOARD", [
            "date" => date("d/m/y"),
            "solo_kills" => $statistics->getKills(Mode::SOLOS),
            "solo_wins" => $statistics->getWins(Mode::SOLOS),
            "doubles_kills" => $statistics->getKills(Mode::DUOS),
            "doubles_wins" => $statistics->getWins(Mode::DUOS),
            "coins" => $statistics->getCoins(),
            "souls" => $statistics->getSouls(),
            "tokens" => $statistics->getTokens(),
        ]);
    }
    
}