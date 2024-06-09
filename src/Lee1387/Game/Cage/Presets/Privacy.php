<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage\Presets;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;

class Privacy extends DefaultCage
{

    protected function getFillingBlock(): Block 
    {
        return VanillaBlocks::COAL();
    }

}