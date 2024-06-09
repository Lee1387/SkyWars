<?php

declare(strict_types=1);

namespace Lee1387\Game\Chest;

use pocketmine\block\tile\Chest;
use pocketmine\math\Vector3;
use pocketmine\world\World;

class ChestTile extends Chest 
{

    public function __construct(World $world, Vector3 $pos) 
    {
        parent::__construct($world, $pos);

        $this->inventory = new ChestInventory($this->position);
    }
}