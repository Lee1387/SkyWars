<?php

declare(strict_types=1);

namespace Lee1387\Item\Spectator;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class SpectatorSettingsItem extends SpectatorItem 
{

    public function __construct()
    {
        parent::__construct("spectator_settings", new MessageContainer("SPECTATOR_SETTINGS"));
    }

    public function onInteract(Session $session): void
    {
        // TODO: Implement onInteract() method.
    }

    protected function realItem(): Item
    {
        return VanillaBlocks::REDSTONE_COMPARATOR()->asItem();
    }
    
}