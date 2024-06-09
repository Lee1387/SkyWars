<?php

declare(strict_types=1);

namespace Lee1387\Session\Scoreboard;

use Lee1387\Game\Stage\StartingStage;
use function date;

class WaitingScoreboard extends Scoreboard
{

    protected function getLines(): array 
    {
        $game = $this->session->getGame();
        $map = $game->getMap();
        $stage = $game->getStage();
        return [
            10 => "{GRAY}" . date("d/m/y"),
            9 => "     ",
            8 => "{WHITE}Players: {GREEN}" . $game->getPlayersCount() . "/" . $map->getSlots(),
            7 => "     ",
            6 => !$stage instanceof StartingStage ? "{WHITE}Waiting..." : "{WHITE}Starting in {GREEN}" . $stage->getCountdown() . "s",
            5 => "      ",
            4 => "{WHITE}Map: {GREEN}" . $map->getName(),
            3 => "{WHITE}Mode: {GREEN}" . $game->getDifficulty()->getDisplayName()
        ];
    }
}