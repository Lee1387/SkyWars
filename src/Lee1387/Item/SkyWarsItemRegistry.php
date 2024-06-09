<?php

declare(strict_types=1);

namespace Lee1387\Item;

use pocketmine\item\Item;
use pocketmine\utils\CloningRegistryTrait;
use Lee1387\Item\Game\KitSelectorItem;
use Lee1387\Item\Game\LeaveGameItem;
use Lee1387\Item\Game\SkyWarsChallengesItem;
use Lee1387\Item\Spectator\PlayAgainItem;
use Lee1387\Item\Spectator\ReturnToLobbyItem;
use Lee1387\Item\Spectator\SpectatorSettingsItem;
use Lee1387\Item\Spectator\TeleporterItem;

/**
 * @method static Item KIT_SELECTOR()
 * @method static Item LEAVE_GAME()
 * @method static Item SKYWARS_CHALLENGES()
 * @method static Item PLAY_AGAIN()
 * @method static Item RETURN_TO_LOBBY()
 * @method static Item SPECTATOR_SETTINGS()
 * @method static Item TELEPORTER()
 */

class SkyWarsItemRegistry 
{

    use CloningRegistryTrait
    {
        preprocessMember as _preprocessMember;
        _registryFromString as fromString;
    }

    static protected function setup(): void 
    {
        self::register("kit_selector", new KitSelectorItem());
        self::register("leave_game", new LeaveGameItem());
        self::register("skywars_challenges", new SkyWarsChallengesItem());

        self::register("play_again", new PlayAgainItem());
        self::register("return_to_lobby", new ReturnToLobbyItem());
        self::register("spectator_settings", new SpectatorSettingsItem());
        self::register("teleporter", new TeleporterItem());
    }

    static public function fromName(string $name): object 
    {
        return self::fromString($name);
    }

    static public function _registryFromString(string $name): Item 
    {
        return self::fromString($name)->asItem();
    }

    static private function register(string $name, SkyWarsItem $item): void 
    {
        self::_registryRegister($name, $item);
    }
    
}