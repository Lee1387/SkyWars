<?php

declare(strict_types=1);

namespace Lee1387\Game\Kit;

use pocketmine\utils\CloningRegistryTrait;
use Lee1387\Game\Kit\Presets\Armorer;
use Lee1387\Game\Kit\Presets\Armorsmith;
use Lee1387\Game\Kit\Presets\BaseballPlayer;
use Lee1387\Game\Kit\Presets\Batguy;
use Lee1387\Game\Kit\Presets\Cactus;
use Lee1387\Game\Kit\Presets\Cannoneer;
use Lee1387\Game\Kit\Presets\DefaultKit;

/**
 * @method static Armorer ARMORER()
 * @method static Armorsmith ARMORSMITH()
 * @method static BaseballPlayer BASEBALL_PLAYER()
 * @method static Batguy BATGUY()
 * @method static Cactus CACTUS()
 * @method static Cannoneer CANNONEER()
 * @method static DefaultKit DEFAULT()
 */

class KitRegistry 
{

    use CloningRegistryTrait;

    /**
     * @return Kit[]
     */
    static public function getAll(): array 
    {
        return self::_registryGetAll();
    }

    static protected function setup(): void 
    {
        self::register("armorer", new Armorer());
        self::register("armorsmith", new Armorsmith());
        self::register("baseball_player", new BaseballPlayer());
        self::register("batguy", new Batguy());
        self::register("cactus", new Cactus());
        self::register("cannoneer", new Cannoneer());
        self::register("default", new DefaultKit());
    }

    static private function register(string $name, Kit $kit): void
    {
        self::_registryRegister($name, $kit);
    }
}