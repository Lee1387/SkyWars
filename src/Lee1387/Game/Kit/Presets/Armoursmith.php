<?php

declare(strict_types=1);

namespace Lee1387\Game\Kit\Presets;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\EnchantedBook;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\VanillaItems;
use Lee1387\Game\Kit\Kit;
use Lee1387\Game\Kit\Rarity;

class Armoursmith extends Kit 
{

    public function __construct() 
    {
        parent::__construct("Armoursmith", Rarity::COMMON);
    }

    protected function getNormalContents(): array
    {
        return [
            VanillaBlocks::ANVIL()->asItem(),
            VanillaItems::ENCHANTED_BOOK()
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 3))
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 1)),
            VanillaItems::EXPERIENCE_BOTTLE()->setCount(64)
        ];
    }

    protected function getNormalArmourContents(): array
    {
        return [
            VanillaItems::DIAMOND_HELMET()
        ];
    }

    protected function getInsaneContents(): array
    {
        return [
            VanillaBlocks::ANVIL()->asItem(),
            VanillaItems::ENCHANTED_BOOK()
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 4))
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 1))
                ->addEnchantment(new EnchantmentInstance(VanillaEnchantments::INFINITY(), 1)),
            VanillaItems::EXPERIENCE_BOTTLE()->setCount(64)
        ];
    }

    protected function getInsaneArmourContents(): array
    {
        return [
            VanillaItems::DIAMOND_HELMET()
        ];
    }

}