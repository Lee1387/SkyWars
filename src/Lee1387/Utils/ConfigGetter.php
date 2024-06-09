<?php

declare(strict_types=1);

namespace Lee1387\Utils;

use Lee1387\SkyWars;

class ConfigGetter 
{
    
    static private function get(string $key): mixed 
    {
        return SkyWars::getInstance()->getConfig()->get($key);
    }

    static public function getChestRefillDelay(): int 
    {
        return self::get("chest-refill-delay");
    }
}