<?php

declare(strict_types=1);

namespace Lee1387\Game;

use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\utils\Utils;
use pocketmine\world\World;
use Lee1387\Game\Map\Map;
use Lee1387\Game\Stage\Stage;
use Lee1387\Game\Stage\WaitingStage;
use Lee1387\Game\Team\Team;
use Lee1387\Session\Session;

class Game 
{

    private int $id;

    private Map $map;
    private Stage $stage;
    private Difficulty $difficulty = Difficulty::NORMAL;

    private ?World $world = null;

    /** @var Team[] */
    private array $teams;

    /** @var Vector3[] */
    private array $blocks = [];

    /** @var Session[] */
    private array $players = [];

    /** @var Session[] */
    private array $spectators = [];

    public function __construct(Map $map, int $id) 
    {
        $this->map = $map;
        $this->id = $id;
        $this->teams = Utils::cloneObjectArray($map->getTeams());

        $this->setStage(new WaitingStage());
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getMap(): Map 
    {
        return $this->map;
    }

    public function getStage(): Stage 
    {
        return $this->stage;
    }

    public function getDifficulty(): Difficulty 
    {
        return $this->difficulty;
    }

    public function getWorld(): ?World 
    {
        return $this->world;
    }

    /**
     * @return Team[]
     */
    public function getTeams(): array 
    {
        return $this->teams;
    }

    /**
     * @return Session[] 
     */
    public function getPlayers(): array 
    {
        return $this->players;
    }

    /**
     * @return Session[] 
     */
    public function getSpectators(): array 
    {
        return $this->spectators;
    }

    /**
     * @return Session[] 
     */
    public function getPlayersAndSpectators(): array 
    {
        return array_merge($this->players, $this->spectators);
    }

    public function getPlayersCount(): int 
    {
        return count($this->players);
    }

    public function checkBlock(Vector3 $position): bool 
    {
        foreach($this->blocks as $index => $block) {
            if ($block->equals($position)) {
                unset($this->blocks[$index]);
                return true;
            }
        }
        return false;
    }

    public function isPlaying(Session $session): bool 
    {
        return in_array($session, $this->players, true);
    }

    public function isSpectator(Session $session): bool 
    {
        return in_array($session, $this->spectators, true);
    }

    public function setStage(Stage $stage): void 
    {
        $this->stage = $stage;
        $this->stage->start($this);
    }

    public function setDifficulty(Difficulty $difficulty): void 
    {
        $this->difficulty = $difficulty;
    }

    public function addBlock(Vector3 $position): void 
    {
        $this->blocks[] = $position;
    }

    public function addPlayer(Session $session): void 
    {
        $this->players[] = $session;

        $this->stage->onJoin($session);
    }

    public function removePlayer(Session $session): void 
    {
        unset($this->players[array_search($session, $this->players, true)]);

        $this->stage->onQuit($session);
    }

    public function addSpectator(Session $session): void 
    {
        $this->spectators[] = $session;
    }

    public function removeSpectator(Session $session): void 
    {
        unset($this->spectators[array_search($session, $this->spectators, true)]);
    }

    public function broadcastMessage(string $message): void 
    {
        foreach ($this->getPlayersAndSpectators() as $session) {
            $session->message($message);
        }
    }

    public function unloadWorld(): void 
    {
        if ($this->world !== null) {
            Server::getInstance()->getWorldManager()->unloadWorld($this->world);

            $this->world = null;
            $this->blocks = [];
        }
    }
    
}