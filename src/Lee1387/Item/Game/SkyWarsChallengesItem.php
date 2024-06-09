<?php

declare(strict_types=1);

namespace Lee1387\Item\Game;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class SkyWarsChallengesItem extends GameItem 
{

    public function __construct()
    {
        parent::__construct("skywars_challenges", new MessageContainer("SKYWARS_CHALLENGES"));
    }

    public function onInteract(Session $session): void
    {
        // TODO: Send challenges form
    }

    protected function realItem(): Item
    {
        return VanillaItems::BLAZE_POWDER();
    }
    
}