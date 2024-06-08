<?php

declare(strict_types=1);

namespace Lee1387\Game\Kit\Presets;

use pocketmine\item\VanillaItems;
use Lee1387\Game\Kit\Kit;
use Lee1387\Game\Kit\Rarity;

class DefaultKit extends Kit 
{

    public function __construct()
    {
        parent::__construct("Default", Rarity::COMMON);
    }

    protected function getNormalContents(): array
    {
        return [
            VanillaItems::STONE_PICKAXE(),
            VanillaItems::STONE_AXE(),
            VanillaItems::STONE_SHOVEL()
        ];
    }

    protected function getInsaneContents(): array
    {
        return [
            VanillaItems::IRON_PICKAXE(),
            VanillaItems::IRON_AXE(),
            VanillaItems::IRON_SHOVEL()
        ];
    }

}