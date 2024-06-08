<?php

declare(strict_types=1);

namespace Lee1387\Game\Kit;

use pocketmine\item\Item;

abstract class Kit 
{

    private string $name;

    private Rarity $rarity;

    public function __construct(string $name, Rarity $rarity) 
    {
        $this->name = $name;
        $this->rarity = $rarity;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function getRarity(): Rarity 
    {
        return $this->rarity;
    }

    /**
     * @return Item[] 
     */
    protected function getNormalContents(): array 
    {
        return [];
    }

    /**
     * @return Item[]
     */
    protected function getNormalArmourContents(): array 
    {
        return [];
    }

    /**
     * @return Item[]
     */
    protected function getInsaneContents(): array 
    {
        return [];
    }

    /**
     * @return Item[] 
     */
    protected function getInsaneArmourContents(): array 
    {
        return [];
    }
    
}