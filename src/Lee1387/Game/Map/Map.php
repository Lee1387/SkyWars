<?php

declare(strict_types=1);

namespace Lee1387\Game\Map;

use pocketmine\math\Vector3;
use pocketmine\world\World;
use Lee1387\Game\Team\Team;

class Map 
{

    use MapProperties;

    /** @var Team[] */
    private array $teams;

    /**
     * @param Team[] $teams
     */
    public function __construct(string $id, string $name, World $waitingWorld, Vector3 $spectatorSpawnPosition, Mode $mode, int $slots, array $teams) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->waitingWorld = $waitingWorld;
        $this->spectatorSpawnPosition = $spectatorSpawnPosition;
        $this->mode = $mode;
        $this->slots = $slots;
        $this->teams = $teams;
    }

    /**
     * @return Team[] 
     */
    public function getTeams(): array 
    {
        return $this->teams;
    }
    
}