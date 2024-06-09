<?php

declare(strict_types=1);

namespace Lee1387\Item\Spectator;

use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class ReturnToLobbyItem extends SpectatorItem 
{

    public function __construct()
    {
        parent::__construct("return_to_lobby", new MessageContainer("RETURN_TO_LOBBY"));
    }

    public function onInteract(Session $session): void
    {
        $session->getGame()->removeSpectator($session);
    }

    protected function realItem(): Item
    {
        return VanillaBlocks::BED()->setColor(DyeColor::RED)->asItem();
    }
    
}