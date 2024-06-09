<?php

declare(strict_types=1);

namespace Lee1387\Session;

use pocketmine\player\Player;
use Lee1387\Game\Game;
use Lee1387\Game\Team\Team;
use Lee1387\Utils\ColorUtils;

class Session 
{

    private Player $player;

    private ?Game $game = null;
    private ?Team $team = null;

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

    public function getGame(): ?Game 
    {
        return $this->game;
    }

    public function getTeam(): ?Team 
    {
        return $this->team;
    }

    public function hasGame(): bool 
    {
        return $this->game !== null;
    }

    public function hasTeam(): bool 
    {
        return $this->team !== null;
    }

    public function isPlaying(): bool 
    {
        return $this->hasGame() and $this->game->isPlaying($this);
    }

    public function isSpectator(): bool 
    {
        return $this->hasGame() and $this->game->isSpectator($this);
    }

    public function setGame(?Game $game): void 
    {
        $this->game = $game;
    }

    public function setTeam(?Team $team): void 
    {
        $this->team = $team;
    }

    public function clearInventories(): void 
    {
        $this->player->getCursorInventory()->clearAll();
        $this->player->getOffHandInventory()->clearAll();
        $this->player->getArmorInventory()->clearAll();
        $this->player->getInventory()->clearAll();
    }

    public function message(string $message): void 
    {
        $this->player->sendMessage(ColorUtils::translate($message));
    }
    
}