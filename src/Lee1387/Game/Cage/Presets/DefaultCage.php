<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage\Presets;

use pocketmine\block\VanillaBlocks;
use pocketmine\math\Vector3;
use pocketmine\world\Position;
use Lee1387\Game\Cage\Cage;

class DefaultCage extends Cage 
{

    public function build(Position $position): void 
    {
        foreach($this->getBlocks($position) as $block) {
            $position->getWorld()->setBlock($block, VanillaBlocks::GLASS());
        }
    }

    /**
     * @return Vector3[] 
     */
    protected function getBlocks(Vector3 $position): array 
    {
        $blocks = [];
        for($y = -1; $y <= 4; $y++) {
            for($i = -1; $i <= 1; $i += 2) {
                $blocks[] = $position->add($i, $y, 0);
                $blocks[] = $position->add(0, $y, $i);

                if($y === -1 or $y === 4) {
                    $blocks[] = $position->add(0, $y, 0);
                }
            }
        }
        return $blocks;
    }

}