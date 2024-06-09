<?php

declare(strict_types=1);

namespace Lee1387\Game\Kit\Presets;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\VanillaItems;
use Lee1387\Game\Kit\Kit;
use Lee1387\Game\Kit\Rarity;

class Batguy extends Kit
{

    public function __construct() 
    {
        parent::__construct("Batguy", Rarity::COMMON);
    }

    protected function getNormalContents(): array
    {
        return [
            // TODO: Potion (8s of Blindness) & 5x Bat Egg
        ];
    }

    protected function getNormalArmorContents(): array
    {
        return [
            VanillaItems::LEATHER_CAP(),
            VanillaItems::LEATHER_TUNIC(),
            VanillaItems::LEATHER_PANTS(),
            VanillaItems::LEATHER_BOOTS()
        ];
    }

    protected function getInsaneContents(): array
    {
        return [
            // TODO: Potion (11s of Blindness) & 10x Bat Egg 
        ];
    }

    protected function getInsaneArmorContents(): array
    {
        $protection = new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 2);
        return [
            VanillaItems::IRON_HELMET()->addEnchantment($protection),
            VanillaItems::LEATHER_TUNIC(),
            VanillaItems::LEATHER_PANTS(),
            VanillaItems::IRON_BOOTS()->addEnchantment($protection)
        ];
    }

}