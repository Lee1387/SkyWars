<?php

declare(strict_types=1);

namespace Lee1387;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use Lee1387\Listener\SessionListener;

class SkyWars extends PluginBase
{
    
    protected function onEnable(): void
    {
        $this->registerListener(new SessionListener());
    }

    private function registerListener(Listener $listener): void 
    {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }
    
}