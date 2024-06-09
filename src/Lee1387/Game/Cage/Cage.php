<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage;

use pocketmine\block\VanillaBlocks;
use pocketmine\math\Vector3;
use pocketmine\world\BlockTransaction;
use pocketmine\world\Position;
use pocketmine\world\World;

abstract class Cage 
{

    protected ?BlockTransaction $transaction = null;
    
    public function __construct() 
    {

    }

    public function build(Position $position): void 
    {
        $this->transaction = new BlockTransaction($position->getWorld());
        $this->setBlocks($position);
        $this->transaction->apply();
    }

    public function destroy(World $world): void 
    {
        if($this->transaction !== null) {
            foreach($this->transaction->getBlocks() as [$x, $y, $z, $block]) {
                $world->setBlockAt($x, $y, $z, VanillaBlocks::AIR());
            }
            $this->transaction = null;
        }
    }

    abstract protected function setBlocks(Vector3 $position): void;
    
}