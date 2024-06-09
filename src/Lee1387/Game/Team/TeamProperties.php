<?php

declare(strict_types=1);

namespace Lee1387\Game\Team;

use pocketmine\block\utils\DyeColor;
use pocketmine\math\Vector3;
use Lee1387\Utils\ColorUtils;
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

    public function getColor(): string 
    {
        return ColorUtils::translate("{" . strtoupper($this->name) . "}");
    }

    public function getDyeColor(): DyeColor 
    {
        return ColorUtils::getDyeColor($this->getColor());
    }

    public function getSpawnPoint(): Vector3 
    {
        return $this->spawnPoint;
    }
    
}