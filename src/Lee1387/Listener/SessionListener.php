<?php

declare(strict_types=1);

namespace Lee1387\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use Lee1387\Session\SessionFactory;

class SessionListener implements Listener
{

    public function onLogin(PlayerLoginEvent $event): void 
    {
        SessionFactory::createSession($event->getPlayer());
    }

    /**
     * @priority HIGHEST
     */
    public function onQuit(PlayerQuitEvent $event): void 
    {
        SessionFactory::removeSession($event->getPlayer());
    }
    
}