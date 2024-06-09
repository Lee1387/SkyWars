<?php

declare(strict_types=1);

namespace Lee1387\Game\Chest;

use pocketmine\block\inventory\ChestInventory;
use pocketmine\utils\TextFormat;
use pocketmine\world\particle\FloatingTextParticle;
use Lee1387\Game\Game;
use Lee1387\Utils\ConfigGetter;
use Lee1387\Utils\InventoryUtils;

class GameChest 
{

    private ChestInventory $inventory;
    private FloatingTextParticle $floatingTextParticle;

    private int $time;

    public function __construct(ChestInventory $inventory)
    {
        $this->inventory = $inventory;
        $this->floatingTextParticle = new FloatingTextParticle("");
        $this->time = ConfigGetter::getChestRefillDelay();
        $this->updateFloatingText();

        InventoryUtils::fillChest($inventory);
    }

    public function getInventory(): ChestInventory 
    {
        return $this->inventory;
    }

    public function getFloatingTextParticle(): FloatingTextParticle
    {
        return $this->floatingTextParticle;
    }

    public function attemptToRefill(Game $game): void 
    {
        $this->time--;

        if($this->time <= 0) {
            $this->refill($game);
        }
        $this->updateFloatingText();
    }

    private function refill(Game $game): void 
    {
        InventoryUtils::fillChest($this->inventory);

        $game->closeChest($this->inventory);

        $this->floatingTextParticle->setInvisible();
    }

    public function updateFloatingText(): void 
    {
        $this->floatingTextParticle->setText(TextFormat::YELLOW . gmdate("i:s", $this->time));

        $position = $this->inventory->getHolder();
        $position->getWorld()->addParticle($position->add(0.5, 1, 0.5), $this->floatingTextParticle);
    }
}