<?php

declare(strict_types=1);

namespace Lee1387\Game\Team;

use pocketmine\math\Vector3;
use Lee1387\Utils\ColourUtils;
use function strtoupper;

trait TeamProperties 
{

    protected string $name;

    protected Vector3 $spawnPoint;

    /**
     * @return string
     */

    public function getName(): string 
    {
        return $this->name;
    }

    public function getColour(): string 
    {
        return ColourUtils::translate("{" . strtoupper($this->name) . "}");
    }

    public function getSpawnPoint(): Vector3 
    {
        return $this->spawnPoint;
    }
    
}