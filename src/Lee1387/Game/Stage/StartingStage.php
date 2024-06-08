<?php

declare(strict_types=1);

namespace Lee1387\game\Stage;

use Lee1387\Game\Stage\Trait\JoinableTrait;
use Lee1387\Session\Session;

class StartingStage extends Stage 
{

    use JoinableTrait {
        onQuit as onSessionQuit;
    }

    private int $countdown = 10;

    public function getCountdown(): int 
    {
        return $this->countdown;
    }

    public function onQuit(Session $session): void 
    {
        $this->onSessionQuit($session);
        $this->stopIfNotReady();
    }

    public function tick(): void 
    {
        if($this->countdown <= 0) {
            $this->game->setStage(new PlayingStage());
        }

        $this->countdown--;
    }

    private function stopIfNotReady(): void 
    {
        // todo
    }
    
}