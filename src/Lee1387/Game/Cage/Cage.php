<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage;

use pocketmine\world\Position;

abstract class Cage 
{
    
    public function __construct() 
    {

    }

    abstract public function build(Position $position): void;
    
}