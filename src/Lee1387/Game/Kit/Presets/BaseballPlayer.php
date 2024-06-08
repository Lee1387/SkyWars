<?php

declare(strict_types=1);

namespace Lee1387\Game\Kit\Presets;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\VanillaItems;
use Lee1387\Game\Kit\Kit;
use Lee1387\Game\Kit\Rarity;

class BaseballPlayer extends Kit 
{

    public function __construct() 
    {
        parent::__construct("Baseball Player", Rarity::RARE);
    }

    protected function getNormalContents(): array
    {
        return [
            VanillaItems::WOODEN_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::KNOCKBACK()))
        ];
    }

    protected function getNormalArmourContents(): array
    {
        return [
            VanillaItems::IRON_HELMET()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION())),
        ];
    }

    protected function getInsaneContents(): array
    {
        return [
            VanillaItems::STONE_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::KNOCKBACK()))
        ];
    }

    protected function getInsaneArmourContents(): array
    {
        return [
            VanillaItems::CHAINMAIL_HELMET()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 4)),
        ];
    }

}