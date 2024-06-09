<?php

declare(strict_types=1);

namespace Lee1387\Session\Scoreboard;

use function date;

class LobbyScoreboard extends Scoreboard
{

    protected function getLines(): array 
    {
        return [
            12 => "{GRAY}" . date("d/m/y"),
            11 => "    ",
            10 => "{WHITE}Solo Kills: {GREEN}148",
            9 => "{WHITE}Solo Wins: {GREEN}14",
            8 => "{WHITE}Doubles Kills: {GREEN}177",
            7 => "{WHITE}Doubles Wins: {GREEN}19",
            6 => "     ",
            5 => "{WHITE}Coins: {GOLD}229.584",
            4 => "{WHITE}Souls: {AQUA}25{GRAY}/100",
            3 => "{WHITE}Tokens: {DARK_GREEN}32.000",
        ];
    }
}