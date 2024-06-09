<?php

declare(strict_types=1);

namespace Lee1387\Item\Game;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class KitSelectorItem extends GameItem 
{

    public function __construct() 
    {
        parent::__construct("kit_selector", new MessageContainer("KIT_SELECTOR"));
    }

    public function onInteract(Session $session): void
    {
        // TODO: Send kit selector form
    }

    protected function realItem(): Item
    {
        return VanillaItems::BOW();
    }
    
}