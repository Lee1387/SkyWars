<?php

declare(strict_types=1);

namespace Lee1387\Game\Chest;

use pocketmine\utils\TextFormat;
use pocketmine\world\particle\FloatingTextParticle;
use Lee1387\Game\Game;
use Lee1387\Utils\ConfigGetter;
use Lee1387\Utils\InventoryUtils;
use function count;
use function gmdate;

class GameChest // should clean class
{

    private ChestInventory $inventory;

    private FloatingTextParticle $floatingTextParticle;
    private FloatingTextParticle $isEmptyFloatingTextParticle;

    private int $time;

    public function __construct(ChestInventory $inventory)
    {
        $this->inventory = $inventory;
        $this->floatingTextParticle = new FloatingTextParticle("");
        $this->isEmptyFloatingTextParticle = new FloatingTextParticle(TextFormat::RED . "Empty!");
        $this->time = ConfigGetter::getChestRefillDelay();
        $this->updateFloatingText();

        InventoryUtils::fillChest($inventory);
    }

    public function attemptToRefill(Game $game): void 
    {
        $this->time--;

        if($this->time <= 0) {
            $this->refill($game);
        }
        $this->updateFloatingText();
    }

    public function refill(Game $game): void 
    {
        InventoryUtils::fillChest($this->inventory);

        $game->closeChest($this->inventory);

        $this->hideFloatingTexts();
        $this->inventory->setNeedsRefill(false);
    }

    public function updateFloatingText(): void 
    {
        $this->floatingTextParticle->setText(TextFormat::YELLOW . gmdate("i:s", $this->time));
        $this->isEmptyFloatingTextParticle->setInvisible(count($this->inventory->getContents()) > 0);

        $position = $this->inventory->getHolder();
        $world = $position->getWorld();

        $world->addParticle($position->add(0.5, $this->isEmptyFloatingTextParticle->isInvisible() ? 1 : 1.25, 0.5), $this->floatingTextParticle);
        $world->addParticle($position->add(0.5, 0.75, 0.5), $this->isEmptyFloatingTextParticle);
    }

    public function hideFloatingTexts(): void 
    {
        $this->floatingTextParticle->setInvisible();
        $this->isEmptyFloatingTextParticle->setInvisible();
    }
}