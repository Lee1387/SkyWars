<?php

declare(strict_types=1);

namespace Lee1387\Game\Stage;

use Lee1387\Game\Game;
use Lee1387\Session\Session;

abstract class Stage 
{

    protected Game $game;

    public function start(Game $game): void 
    {
        $this->game = $game;
        $this->onStart();

        foreach($this->game->getPlayers() as $session) {
            $this->onJoin($session);
        }
    }

    protected function onStart(): void {}

    /**
     * Called when someone joins the game in this stage 
     */
    public function onJoin(Session $session): void {}

    /**
     * Called when someone quits the game in this stage 
     */
    public function onQuit(Session $session): void {}

    abstract public function tick(): void;
    
}