<?php

declare(strict_types=1);

namespace Lee1387\Game\Kit\Presets;

use pocketmine\item\VanillaItems;
use Lee1387\Game\Kit\Kit;
use Lee1387\Game\Kit\Rarity;

class Armourer extends Kit 
{

    public function __construct() 
    {
        parent::__construct("Armourer", Rarity::RARE);
    }

    protected function getNormalArmourContents(): array
    {
        return [
            VanillaItems::GOLDEN_CHESTPLATE(),
            VanillaItems::GOLDEN_LEGGINGS()
        ];
    }

    protected function getInsaneArmourContents(): array
    {
        return [
            VanillaItems::DIAMOND_CHESTPLATE(),
            VanillaItems::IRON_LEGGINGS()
        ];
    }

    protected function getInsaneContents(): array
    {
        return [
            // TODO: Potion of Resistance 1 (10s)
        ];
    }

}