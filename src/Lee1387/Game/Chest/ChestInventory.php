<?php

declare(strict_types=1);

namespace Lee1387\Game\Chest;

use pocketmine\block\inventory\ChestInventory as PMChestInventory;
use pocketmine\player\Player;

class ChestInventory extends PMChestInventory 
{

    private bool $needsRefill = false;

    public function onOpen(Player $who): void 
    {
        if(!$this->needsRefill) {
            $this->needsRefill = true;
            parent::onOpen($who);
        }
    }

    public function onClose(Player $who): void 
    {
        if(!$this->needsRefill) {
            parent::onClose($who);
        }
    }

    public function setNeedsRefill(bool $needsRefill): void 
    {
        $this->needsRefill = $needsRefill;
        $this->animateBlock(false);
    }
}