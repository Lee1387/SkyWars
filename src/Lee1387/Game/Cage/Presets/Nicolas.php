<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage\Presets;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;

class Nicolas extends DefaultCage
{

    protected function getFillingBlock(): Block 
    {
        return VanillaBlocks::MONSTER_SPAWNER();
    }

}