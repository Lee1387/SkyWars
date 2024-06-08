<?php

declare(strict_types=1);

namespace Lee1387\Game\Stage;

use Lee1387\Game\Stage\Trait\JoinableTrait;
use Lee1387\Session\Session;

class WaitingStage extends Stage 
{

    use JoinableTrait {
        onJoin as onSessionJoin;
    }

    public function onJoin(Session $session): void 
    {
        $this->onSessionJoin($session);
        $this->startIfReady();
    }

    private function startIfReady(): void 
    {
        // todo
    }

    public function tick(): void {}
    
}