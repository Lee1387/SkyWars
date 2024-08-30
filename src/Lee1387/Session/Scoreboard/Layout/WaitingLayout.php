<?php

declare(strict_types=1);

namespace Lee1387\Session\Scoreboard\Layout;

use Lee1387\game\Stage\StartingStage;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class WaitingLayout implements Layout
{

    public function getMessageContainer(Session $session): MessageContainer
    {
        $game = $session->getGame();
        $map = $game->getMap();
        $stage = $game->getStage();

        return new MessageContainer("WAITING_SCOREBOARD", [
            "date" => date("d/m/y"),
            "players_count" => $game->getPlayersCount(),
            "slots" => $map->getSlots(),
            "stage" => !$stage instanceof StartingStage ? new MessageContainer("WAITING_STAGE") : new MessageContainer("STARTING_STAGE", ["time" => $stage->getCountdown()]),
            "map" => $map->getName(),
            "mode" => $game->getDifficulty()->getDisplayName(),
        ]);
    }

}