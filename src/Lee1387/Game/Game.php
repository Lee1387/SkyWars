<?php

declare(strict_types=1);

namespace Lee1387\Game;

use pocketmine\Server;
use pocketmine\utils\Utils;
use pocketmine\world\sound\Sound;
use pocketmine\world\World;
use pocketmine\world\WorldException;
use Lee1387\Game\Chest\ChestInventory;
use Lee1387\Game\Chest\GameChest;
use Lee1387\Game\Map\Map;
use Lee1387\Game\Stage\Stage;
use Lee1387\game\Stage\StartingStage;
use Lee1387\Game\Stage\WaitingStage;
use Lee1387\Game\Team\Team;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;
use function array_key_exists;
use function array_search;
use function in_array;
use function spl_object_id;

class Game 
{

    private int $id;

    private Map $map;
    private Stage $stage;
    private Difficulty $difficulty = Difficulty::NORMAL;

    private ?World $world = null;

    /** @var Team[] */
    private array $teams;

    /** @var GameChest[] */
    private array $openedChests = [];

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
        return Server::getInstance()->getWorldManager()->getWorldByName("world"); // just for testing
        return $this->world;
    }

    /**
     * @return GameChest[]
     */
    public function getOpenedChests(): array 
    {
        return $this->openedChests;
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

    public function canBeJoined(): bool 
    {
        return $this->getPlayersCount() < $this->map->getSlots() and ($this->stage instanceof WaitingStage or $this->stage instanceof StartingStage);
    }

    private function isChestOpened(ChestInventory $inventory): bool 
    {
        return array_key_exists(spl_object_id($inventory), $this->openedChests);
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

    public function openChest(ChestInventory $inventory): void 
    {
        if(!$this->isChestOpened($inventory)) {
            $this->openedChests[spl_object_id($inventory)] = new GameChest($inventory);
        }
    }

    public function closeChest(ChestInventory $inventory): void 
    {
        if($this->isChestOpened($inventory)) {
            $chest = $this->openedChests[$chestId = spl_object_id($inventory)];
            $chest->hideFloatingTexts();
            $chest->updateFloatingText();

            unset($this->openedChests[$chestId]);
        }
    }

    public function addPlayer(Session $session): void 
    {
        $this->players[] = $session;

        $this->stage->onJoin($session);
    }

    public function removePlayer(Session $session, bool $teleportToHub = true, bool $setSpectator = false): void 
    {
        unset($this->players[array_search($session, $this->players, true)]);

        $this->stage->onQuit($session);

        if($teleportToHub) {
            $session->teleportToHub();
        }

        if($setSpectator) {
            $this->addSpectator($session);
        } else {
            $session->setGame(null);
        }
    }

    public function addSpectator(Session $session): void 
    {
        $this->spectators[] = $session;

        $session->giveSpectatorItems();
    }

    public function removeSpectator(Session $session): void 
    {
        unset($this->spectators[array_search($session, $this->spectators, true)]);

        $session->setGame(null);
        $session->teleportToHub();
    }

    public function broadcastMessage(MessageContainer $container): void 
    {
        foreach ($this->getPlayersAndSpectators() as $session) {
            $session->sendMessage($container);
        }
    }

    public function broadcastTitle(MessageContainer $title, ?MessageContainer $subtitle = null, int $fadeIn = -1, int $stay = -1, int $fadeOut = -1): void 
    {
        foreach($this->getPlayersAndSpectators() as $session) {
            $session->sendTitle($title, $subtitle, $fadeIn, $stay, $fadeOut);
        }
    }

    public function broadcastActionBar(MessageContainer $container): void 
    {
        foreach($this->getPlayersAndSpectators() as $session) {
            $session->sendActionBar($container);
        }
    }

    public function broadcastSound(Sound $sound): void 
    {
        foreach($this->getPlayersAndSpectators() as $session) {
            $session->playSound($sound);
        }
    }

    public function unloadWorld(): void 
    {
        if ($this->world !== null) {
            Server::getInstance()->getWorldManager()->unloadWorld($this->world);

            $this->world = null;
        }
    }

    public function setupWorld(): void 
    {
        $name = $this->map->getName() . "-" . $this->id;

        $world_manager = Server::getInstance()->getWorldManager();
        if(!$world_manager->loadWorld($name)) {
            throw new WorldException("Failed to load world");
        }

        $this->world = $world_manager->getWorldByName($name);
        $this->world->setAutoSave(false);
        $this->world->setTime(World::TIME_DAY);
        $this->world->stopTime();
    }
    
}