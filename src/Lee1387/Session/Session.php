<?php

declare(strict_types=1);

namespace Lee1387\Session;

use pocketmine\player\Player;
use Lee1387\Utils\ColourUtils;

class Session 
{

    private Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function getPlayer(): Player 
    {
        return $this->player;
    }

    public function getUsername(): string 
    {
        return $this->player->getName();
    }

    public function message(string $message): void 
    {
        $this->player->sendMessage(ColourUtils::translate($message));
    }
    
}