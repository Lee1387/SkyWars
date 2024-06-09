<?php

declare(strict_types=1);

namespace Lee1387\Session\Scoreboard;

use function date;

class GameScoreboard extends Scoreboard 
{

    protected function getLines(): array 
    {
        $game = $this->session->getGame();
        return [
            13 => "{GRAY}" . date("d/m/y"),
            12 => "    ",
            11 => "{WHITE}Next Event:",
            10 => "{GREEN}Refill 2:58",
            9 => "     ",
            8 => "{WHITE}Players left: {GREEN}" . $game->getPlayersCount(),
            7 => "      ",
            6 => "{WHITE}Kills: {GREEN}0",
            5 => "       ",
            4 => "{WHITE}Map: {GREEN}" . $game->getMap()->getName(),
            3 => "{WHITE}Mode: {GREEN}" . $game->getDifficulty()->getDisplayName()
        ];
    }
}