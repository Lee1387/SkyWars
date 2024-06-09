<?php

declare(strict_types=1);

namespace Lee1387\Item;

use pocketmine\item\Item;
use pocketmine\utils\TextFormat;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

abstract class SkyWarsItem 
{

    private string $id;
    private string $name;

    public function __construct(string $id, MessageContainer $name) 
    {
        $this->id = $id;
        $this->name = $name->getMessage();
    }

    public function asItem(): Item 
    {
        $item = $this->realItem();
        $item->setCustomName($this->name);
        $item->getNamedTag()->setString("skywars", $this->id);
        return $item;
    }

    abstract public function canBeInteracted(Session $session): bool;

    abstract public function onInteract(Session $session): void;

    abstract protected function realItem(): Item;
}