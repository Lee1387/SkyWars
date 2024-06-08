<?php

declare(strict_types=1);

namespace Lee1387;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Lee1387\Game\GameHeartbeat;
use Lee1387\Game\GameManager;
use Lee1387\Listener\SessionListener;

class SkyWars extends PluginBase
{

    use SingletonTrait;

    private GameManager $gameManager;

    protected function onLoad(): void 
    {
        self::setInstance($this);
    }
    
    protected function onEnable(): void
    {
        $this->gameManager = new GameManager();

        $this->registerListener(new SessionListener());

        $this->getScheduler()->scheduleRepeatingTask(new GameHeartbeat(), 20);
    }

    private function registerListener(Listener $listener): void 
    {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }

    public function getGameManager(): GameManager 
    {
        return $this->gameManager;
    }
    
}