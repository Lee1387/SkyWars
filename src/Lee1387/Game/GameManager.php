<?php

declare(strict_types=1);

namespace Lee1387\Game;

class GameManager 
{

    private int $next_game_id = 0;

    /** @var Game[] */
    private array $games = [];

    public function __construct()
    {

    }

    public function getNextGameId(): int 
    {
        return $this->next_game_id++;
    }

    /**
     * @return Game[]
     */
    public function getGames(): array 
    {
        return $this->games;
    }

    public function addGame(Game $game): void 
    {
        $this->games[$game->getId()] = $game;
    }

    public function removeGame(int $id): void 
    {
        unset($this->games[$id]);
    }
    
}