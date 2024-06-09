<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage\Presets;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\math\Vector3;
use Lee1387\Game\Cage\Cage;

class DefaultCage extends Cage 
{

    public function setBlocks(Vector3 $position): void 
    {
        $block = $this->getFillingBlock();

        for($y = -1; $y <= 4; $y++) {
            for($i = -1; $i <= 1; $i += 2) {
                $this->transaction->addBlock($position->add($i, $y, 0), $block);
                $this->transaction->addBlock($position->add(0, $y, $i), $block);

                if($y === -1 or $y === 4) {
                    $this->transaction->addBlock($position->add(0, $y, 0), $block);
                }
            }
        }
    }

    protected function getFillingBlock(): Block 
    {
        return VanillaBlocks::GLASS();
    }
}