<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage\Presets;

use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks;
use pocketmine\world\Position;

class Bubblegum extends DefaultCage
{

    public function build(Position $position): void 
    {
        foreach($this->getBlocks($position) as $block) {
            $position->getWorld()->setBlock($block, VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::PINK));
        }
    }

}