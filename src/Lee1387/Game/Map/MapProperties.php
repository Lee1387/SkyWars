<?php

declare(strict_types=1);

namespace Lee1387\Game\Map;

use pocketmine\math\Vector3;

trait MapProperties 
{

    protected string $id;
    protected string $name;

    protected Vector3 $spectatorSpawnPosition;
    protected Mode $mode;

    protected int $slots;

    public function getId(): string 
    {
        return $this->id;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function getSpectatorSpawnPosition(): Vector3
    {
        return $this->spectatorSpawnPosition;
    }

    public function getMode(): Mode 
    {
        return $this->mode;
    }

    public function getSlots(): int 
    {
        return $this->slots;
    }
    
}