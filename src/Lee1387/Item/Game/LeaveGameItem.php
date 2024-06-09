<?php

declare(strict_types=1);

namespace Lee1387\Item\Game;

use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class LeaveGameItem extends GameItem 
{

    public function __construct()
    {
        parent::__construct("leave_game", new MessageContainer("RETURN_TO_LOBBY"));
    }

    public function onInteract(Session $session): void
    {
        $session->getGame()->removePlayer($session);
    }

    protected function realItem(): Item
    {
        return VanillaBlocks::BED()->setColor(DyeColor::RED)->asItem();
    }
    
}