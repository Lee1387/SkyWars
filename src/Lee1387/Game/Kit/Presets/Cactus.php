<?php

declare(strict_types=1);

namespace Lee1387\Game\Kit\Presets;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\VanillaItems;
use Lee1387\Game\Kit\Kit;
use Lee1387\Game\Kit\Rarity;

class Cactus extends Kit 
{

    public function __construct() 
    {
        parent::__construct("Cactus", Rarity::COMMON);
    }

    protected function getNormalContents(): array
    {
        return [
            VanillaBlocks::CACTUS()->asItem()->setCount(8),
            VanillaBlocks::SAND()->asItem()->setCount(16)
        ];
    }

    protected function getNormalArmourContents(): array
    {
        return [
            VanillaItems::LEATHER_TUNIC()
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::THORNS(), 5))
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 3))
        ];
    }

    protected function getInsaneContents(): array
    {
        return [
            VanillaBlocks::CACTUS()->asItem()->setCount(16),
            VanillaBlocks::SAND()->asItem()->setCount(32)
        ];
    }

    protected function getInsaneArmourContents(): array
    {
        return [
            VanillaItems::LEATHER_TUNIC()
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::THORNS(), 5))
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 3)),
            VanillaItems::LEATHER_PANTS()
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::THORNS(), 3))
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 3)),
        ];
    }

}