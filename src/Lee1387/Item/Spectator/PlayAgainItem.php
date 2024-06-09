<?php

declare(strict_types=1);

namespace Lee1387\Item\Spectator;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class PlayAgainItem extends SpectatorItem 
{

    public function __construct()
    {
        parent::__construct("play_again", new MessageContainer("PLAY_AGAIN"));
    }

    public function onInteract(Session $session): void
    {
        // TODO: Implement onInteract() method.
    }

    protected function realItem(): Item
    {
        return VanillaItems::PAPER();
    }
    
}