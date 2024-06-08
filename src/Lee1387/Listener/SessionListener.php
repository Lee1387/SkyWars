<?php

declare(strict_types=1);

namespace Lee1387\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use Lee1387\Game\Cage\Presets\DefaultCage;
use Lee1387\Session\SessionFactory;

class SessionListener implements Listener
{

    public function onLogin(PlayerLoginEvent $event): void 
    {
        SessionFactory::createSession($event->getPlayer());
    }

    public function onChat(PlayerChatEvent $event): void 
    {
        $cage = new DefaultCage();
        $cage->build($event->getPlayer()->getPosition());

        $event->getPlayer()->sendMessage("§aCage Created!");
    }

    /**
     * @priority HIGHEST
     */
    public function onQuit(PlayerQuitEvent $event): void 
    {
        SessionFactory::removeSession($event->getPlayer());
    }
    
}