<?php

declare(strict_types=1);

namespace Lee1387\Listener;

use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Item;
use Lee1387\Item\SkyWarsItemRegistry;
use Lee1387\Session\SessionFactory;

class ItemListener implements Listener 
{

    public function onTransaction(InventoryTransactionEvent $event): void 
    {
        foreach($event->getTransaction()->getActions() as $action) {
            if($this->getSkyWarsTag($action->getSourceItem()) !== null) {
                $event->cancel();
            }
        }
    }

    public function onUse(PlayerItemUseEvent $event): void 
    {
        $tag = $this->getSkyWarsTag($event->getItem());
        if($tag !== null) {
            SkyWarsItemRegistry::fromName($tag)->onInteract(SessionFactory::getSession($event->getPlayer()));
        }
    }

    private function getSkyWarsTag(Item $item): ?string 
    {
        return $item->getNamedTag()->getTag("skywars")?->getValue();
    }
}