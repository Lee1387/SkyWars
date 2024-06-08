<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage\Presets;

use pocketmine\block\VanillaBlocks;
use pocketmine\world\Position;

class Tree extends DefaultCage
{

    public function build(Position $position): void 
    {
        foreach($this->getBlocks($position) as $block) {
            $position->getWorld()->setBlock($block, VanillaBlocks::OAK_LEAVES());
        }
    }

}