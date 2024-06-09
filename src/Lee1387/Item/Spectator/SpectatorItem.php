<?php

declare(strict_types=1);

namespace Lee1387\Item\Spectator;

use Lee1387\Item\SkyWarsItem;
use Lee1387\Session\Session;

abstract class SpectatorItem extends SkyWarsItem 
{

    public function canBeInteracted(Session $session): bool
    {
        return $session->isSpectator();
    }
    
}