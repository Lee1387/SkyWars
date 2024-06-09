<?php

declare(strict_types=1);

namespace Lee1387;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Lee1387\Game\GameHeartbeat;
use Lee1387\Game\GameManager;
use Lee1387\Listener\GameListener;
use Lee1387\Listener\SessionListener;
use Lee1387\Utils\Message\MessageManager;

class SkyWars extends PluginBase
{

    use SingletonTrait;

    private GameManager $gameManager;
    private MessageManager $messageManager;

    protected function onLoad(): void 
    {
        self::setInstance($this);

        $this->saveResource("messages.json", true); // TODO: Set "replace" to false on production
    }
    
    protected function onEnable(): void
    {
        $this->getServer()->getWorldManager()->loadWorld("world"); // just for testing

        $this->gameManager = new GameManager();
        $this->messageManager = new MessageManager();

        $this->registerListener(new GameListener());
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

    public function getMessageManager(): MessageManager 
    {
        return $this->messageManager;
    }
    
}