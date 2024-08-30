<?php

declare(strict_types=1);

namespace Lee1387\Game\Stage;

use pocketmine\player\GameMode;
use Lee1387\Session\Scoreboard\Layout\GameLayout;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class PlayingStage extends Stage 
{

    protected function onStart(): void 
    {
        $this->game->broadcastMessage(new MessageContainer("CAGES_OPENED"));
    }

    public function onJoin(Session $session): void 
    {
        $session->setScoreboardLayout(new GameLayout());
        $session->getSelectedKit()->apply($session);
        $session->getSelectedCage()->destroy($this->game->getWorld());

        $session->getPlayer()->setGamemode(GameMode::SURVIVAL);
    }

    public function tick(): void 
    {
        foreach($this->game->getOpenedChests() as $chest) {
            $chest->attemptToRefill($this->game);
        }
    }
    
}