<?php

declare(strict_types=1);

namespace Lee1387\Game;

use pocketmine\scheduler\Task;
use Lee1387\SkyWars;

class GameHeartbeat extends Task
{

    public function onRun(): void 
    {
        foreach(SkyWars::getInstance()->getGameManager()->getGames() as $game) {
            $game->getStage()->tick();
        }
    }

}