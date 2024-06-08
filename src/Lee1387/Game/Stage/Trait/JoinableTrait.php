<?php

namespace Lee1387\Game\Stage\Trait;

use Lee1387\Game\Game;
use Lee1387\Session\Session;

trait JoinableTrait 
{

    public function start(Game $game): void 
    {
        $this->game = $game;
    }

    public function onJoin(Session $session): void 
    {
        /*
        $this->game->broadcastMessage(
            "{GRAY}" . $session->getUsername() . " {YELLOW}has joined ({AQUA}" . 
            $this->game->getPlayersCount() . "{YELLOW}/{AQUA}" . $this->game->getMap()->getMaxCapacity() . " {YELLOW})!"
        );
        */
    }

    public function onQuit(Session $session): void 
    {
        $this->game->broadcastMessage("{GRAY}" . $session->getUsername() . " {YELLOW}has quit!");
    }
    
}