<?php

declare(strict_types=1);

namespace Lee1387\Game\Kit\Presets;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\VanillaItems;
use Lee1387\Game\Kit\Kit;
use Lee1387\Game\Kit\Rarity;

class Cannoneer extends Kit 
{

    public function __construct()
    {
        parent::__construct("Cannoneer", Rarity::LEGENDARY);
    }

    protected function getNormalContents(): array
    {
        return [
            VanillaBlocks::TNT()->asItem()->setCount(16),
            VanillaBlocks::REDSTONE()->asItem()->setCount(4),
            VanillaItems::WATER_BUCKET(),
            VanillaBlocks::OAK_PRESSURE_PLATE()->asItem()->setCount(4)
        ];
    }

    protected function getNormalArmorContents(): array
    {
        return [
            3 => VanillaItems::IRON_BOOTS()
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::FEATHER_FALLING(), 4))
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::BLAST_PROTECTION(), 3)),
        ];
    }

    protected function getInsaneContents(): array
    {
        return [
            VanillaBlocks::TNT()->asItem()->setCount(24),
            VanillaBlocks::REDSTONE()->asItem()->setCount(10),
            VanillaItems::WATER_BUCKET(),
            VanillaBlocks::OAK_PRESSURE_PLATE()->asItem()->setCount(4)
        ];
    }

    protected function getInsaneArmorContents(): array
    {
        return [
            3 => VanillaItems::DIAMOND_BOOTS()
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::FEATHER_FALLING(), 4))
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::BLAST_PROTECTION(), 4)),
        ];
    }

}