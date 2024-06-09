<?php

declare(strict_types=1);

namespace Lee1387\Game\Kit\Presets;

use pocketmine\item\VanillaItems;
use Lee1387\Game\Kit\Kit;
use Lee1387\Game\Kit\Rarity;

class Armorer extends Kit 
{

    public function __construct() 
    {
        parent::__construct("Armorer", Rarity::RARE);
    }

    protected function getNormalArmorContents(): array
    {
        return [
            1 => VanillaItems::GOLDEN_CHESTPLATE(),
            2 => VanillaItems::GOLDEN_LEGGINGS()
        ];
    }

    protected function getInsaneArmorContents(): array
    {
        return [
            1 => VanillaItems::DIAMOND_CHESTPLATE(),
            2 => VanillaItems::IRON_LEGGINGS()
        ];
    }

    protected function getInsaneContents(): array
    {
        return [
            // TODO: Potion of Resistance 1 (10s)
        ];
    }

}