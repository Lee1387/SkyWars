<?php

declare(strict_types=1);

namespace Lee1387\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use Lee1387\Session\SessionFactory;
use Lee1387\SkyWars;

class SessionListener implements Listener
{

    public function onLogin(PlayerLoginEvent $event): void 
    {
        SessionFactory::createSession($event->getPlayer());
    }

    public function onJoin(PlayerJoinEvent $event): void 
    {
        SessionFactory::getSession($event->getPlayer())->updateScoreboard();
    }

    public function onChat(PlayerChatEvent $event): void // just for testing
    {
        SkyWars::getInstance()->getGameManager()->getGames()[0]->addPlayer(SessionFactory::getSession($event->getPlayer()));
    }

    /**
     * @priority HIGHEST
     */
    public function onQuit(PlayerQuitEvent $event): void 
    {
        SessionFactory::removeSession($event->getPlayer());
    }
    
}