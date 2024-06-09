<?php

declare(strict_types=1);

namespace Lee1387\Item\Game;

use Lee1387\Item\SkyWarsItem;
use Lee1387\Session\Session;

abstract class GameItem extends SkyWarsItem 
{

    public function canBeInteracted(Session $session): bool
    {
        return $session->isPlaying();
    }
    
}