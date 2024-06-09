<?php

declare(strict_types=1);

namespace Lee1387\Utils;

use pocketmine\item\VanillaItems;
use Lee1387\Game\Chest\ChestInventory;

class InventoryUtils 
{

    static public function fillChest(ChestInventory $inventory): void 
    {
        $inventory->setContents([
            VanillaItems::STEAK()->setCount(3),
            VanillaItems::WOODEN_SWORD(),
            VanillaItems::WOODEN_AXE(),
            VanillaItems::WOODEN_PICKAXE(),
        ]);
    }
}