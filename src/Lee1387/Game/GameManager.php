<?php

declare(strict_types=1);

namespace Lee1387\Game;

use pocketmine\math\Vector3;
use Lee1387\Game\Map\Map;
use Lee1387\Game\Map\Mode;
use Lee1387\Game\Team\Team;

class GameManager 
{

    private int $next_game_id = 0;

    /** @var Game[] */
    private array $games = [];

    public function __construct() // just for testing
    {
        $this->addGame(new Game(new Map(
            "map1",
            "Tree",
            Vector3::zero(),
            Mode::SOLOS,
            2,
            [
                new Team("red", new Vector3(203, 15, 228), 1),
                new Team("blue", new Vector3(224, 15, 228), 1),
            ]
        ), $this->getNextGameId()));
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

    /**
     * @return Game[]
     */
    public function getAvailableGames(Map $map): array 
    {
        $games = [];
        foreach($this->games as $game) {
            if($game->getMap() === $map and $game->canBeJoined()) {
                $games[] = $game;
            }
        }
        return $games;
    }

    public function generateGame(Map $map): void 
    {
        
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