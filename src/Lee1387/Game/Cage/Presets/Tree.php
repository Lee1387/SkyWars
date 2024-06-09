<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage\Presets;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;

class Tree extends DefaultCage
{

    protected function getFillingBlock(): Block 
    {
        return VanillaBlocks::OAK_LEAVES();
    }

}