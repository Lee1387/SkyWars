<?php

declare(strict_types=1);

namespace Lee1387\Session;

use Lee1387\Game\Map\Mode;

class Statistics 
{

    private int $coins = 0;
    private int $souls = 0;
    private int $tokens = 0;

    /** @var int[] */
    private array $kills = [];

    /** @var int[] */
    private array $wins = [];

    public function getCoins(): int 
    {
        return $this->coins;
    }

    public function getSouls(): int 
    {
        return $this->souls;
    }

    public function getTokens(): int 
    {
        return $this->tokens;
    }

    public function getKills(?Mode $mode): int 
    {
        return $this->kills[$mode->value ?? "game"] ?? 0;
    }

    public function getWins(Mode $mode): int 
    {
        return $this->wins[$mode->value] ?? 0;
    }

    public function setKills(?Mode $mode, int $kills): void 
    {
        $this->kills[$mode->value ?? "game"] = $kills;
    }

    public function setWins(Mode $mode, int $wins): void 
    {
        $this->wins[$mode->value] = $wins;
    }

    public function setCoins(int $coins): void 
    {
        $this->coins = $coins;
    }

    public function setSouls(int $souls): void 
    {
        $this->souls = $souls;
    }

    public function setTokens(int $tokens): void 
    {
        $this->tokens = $tokens;
    }

    public function resetKills(): void 
    {
        $this->kills["game"] = 0;
    }
    
}