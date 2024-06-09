<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage\Presets;

use pocketmine\block\Block;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks;

class Lime extends DefaultCage
{

    protected function getFillingBlock(): Block 
    {
        return VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIME);
    }

}