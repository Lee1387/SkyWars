<?php

declare(strict_types=1);

namespace Lee1387\Session;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\sound\Sound;
use Lee1387\Game\Cage\Cage;
use Lee1387\Game\Cage\CageRegistry;
use Lee1387\Game\Game;
use Lee1387\Game\Kit\Kit;
use Lee1387\Game\Kit\KitRegistry;
use Lee1387\Game\Stage\EndingStage;
use Lee1387\Game\Team\Team;
use Lee1387\Item\SkyWarsItemRegistry;
use Lee1387\Session\Scoreboard\LobbyScoreboard;
use Lee1387\Session\Scoreboard\Scoreboard;
use Lee1387\Utils\Message\MessageContainer;

class Session 
{

    private Player $player;
    private Scoreboard $scoreboard;

    private ?Game $game = null;
    private ?Team $team = null;

    private ?Session $lastSessionHit = null;
    private ?Session $trackingSession = null;

    private Kit $selectedKit;
    private Cage $selectedCage;

    /** @var SessionKit[] */
    private array $kits = [];

    /** @var Cage[] */
    private array $cages = [];

    public function __construct(Player $player)
    {
        $this->player = $player;
        $this->selectedKit = KitRegistry::DEFAULT(); // TODO: Get this from the database
        $this->selectedCage = CageRegistry::DEFAULT(); // TODO: Get this from the database
    }

    public function getPlayer(): Player 
    {
        return $this->player;
    }

    public function getUsername(): string 
    {
        return $this->player->getName();
    }

    public function getColoredUsername(): string 
    {
        $username = $this->getUsername();
        if($this->hasTeam()) {
            return $this->team->getColor() . $username;
        }
        return $username;
    }

    public function getGame(): ?Game 
    {
        return $this->game;
    }

    public function getTeam(): ?Team 
    {
        return $this->team;
    }

    public function getLastSessionHit(): ?Session 
    {
        return $this->lastSessionHit;
    }

    public function getTrackingSession(): ?Session 
    {
        return $this->trackingSession;
    }

    public function getSelectedKit(): Kit 
    {
        return $this->selectedKit;
    }

    public function getSelectedCage(): Cage 
    {
        return $this->selectedCage;
    }

    /**
     * @return SessionKit[]
     */
    public function getKits(): array 
    {
        return $this->kits;
    }

    /**
     * @return Cage[]
     */
    public function getCages(): array 
    {
        return $this->cages;
    }

    public function hasGame(): bool 
    {
        return $this->game !== null;
    }

    public function hasTeam(): bool 
    {
        return $this->team !== null;
    }

    public function isConnected(): bool 
    {
        return $this->player->isConnected();
    }

    public function isPlaying(): bool 
    {
        return $this->hasGame() and $this->game->isPlaying($this);
    }

    public function isSpectator(): bool 
    {
        return $this->hasGame() and $this->game->isSpectator($this);
    }

    public function setScoreboard(Scoreboard $scoreboard): void 
    {
        $this->scoreboard = $scoreboard;
    }

    public function setGame(?Game $game): void 
    {
        $this->game = $game;
    }

    public function setTeam(?Team $team): void 
    {
        $this->team = $team;
    }

    public function setLastSessionHit(?Session $lastSessionHit): void 
    {
        $this->lastSessionHit = $lastSessionHit;
    }

    public function setTrackingSession(?Session $trackingSession): void 
    {
        $this->trackingSession = $trackingSession;
        $this->updateCompassDirection();
    }

    public function setSelectedKit(Kit $selectedKit): void 
    {
        $this->selectedKit = $selectedKit;
    }

    public function setSelectedCage(Cage $selectedCage): void 
    {
        $this->selectedCage = $selectedCage;
    }

    /**
     * @param SessionKit[] $kits
     */
    public function setKits(array $kits): void 
    {
        $this->kits = $kits;
    }

    /**
     * @param Cage[] $cages
     */
    public function setCages(array $cages): void 
    {
        $this->cages[] = $cages;
    }

    public function addKit(SessionKit $kit): void 
    {
        $this->kits[] = $kit;
    }

    public function addCage(Cage $cage): void 
    {
        $this->cages[] = $cage;
    }

    public function updateScoreboard(): void 
    {
        $this->scoreboard->show();
    }

    public function updateCompassDirection(): void 
    {
        $this->player->getNetworkSession()->syncWorldSpawnPoint(
            $this->trackingSession !== null ? $this->trackingSession->getPlayer()->getPosition() : $this->player->getWorld()->getSpawnLocation()
        );
    }

    public function assignTeam(): void 
    {
        foreach($this->game->getTeams() as $team) {
            if(!$team->isFull()) {
                $team->addMember($this);
                return;
            }
        }
    }

    public function clearInventories(): void 
    {
        $this->player->getCursorInventory()->clearAll();
        $this->player->getOffHandInventory()->clearAll();
        $this->player->getArmorInventory()->clearAll();
        $this->player->getInventory()->clearAll();
    }

    public function giveWaitingItems(): void 
    {
        $this->clearInventories();

        $inventory = $this->player->getInventory();
        $inventory->setItem(0, SkyWarsItemRegistry::KIT_SELECTOR());
        $inventory->setItem(7, SkyWarsItemRegistry::SKYWARS_CHALLENGES());
        $inventory->setItem(8, SkyWarsItemRegistry::LEAVE_GAME());
    }

    public function giveSpectatorItems(): void 
    {
        $this->clearInventories();

        $inventory = $this->player->getInventory();
        $inventory->setItem(0, SkyWarsItemRegistry::TELEPORTER());
        $inventory->setItem(4, SkyWarsItemRegistry::SPECTATOR_SETTINGS());
        $inventory->setItem(7, SkyWarsItemRegistry::PLAY_AGAIN());
        $inventory->setItem(8, SkyWarsItemRegistry::RETURN_TO_LOBBY());
    }

    public function teleportToHub(): void 
    {
        $this->player->getEffects()->clear();
        $this->player->setGamemode(GameMode::ADVENTURE());
        $this->player->setHealth($this->player->getMaxHealth());
        $this->player->setNameTag($this->player->getDisplayName());
        $this->player->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());

        $this->clearInventories();
        $this->setTrackingSession(null);
        $this->setScoreboard(new LobbyScoreboard($this));
    }

    public function kill(int $cause): void 
    {
        $killerSession = $this->getLastSessionHit();
        $username = $this->getColoredUsername();

        if($killerSession !== null) {
            // TODO: Add coins to the killer 

            $arguments = [
                "player" => $username,
                "killer" => $killerSession->getColoredUsername()
            ];

            if($cause === EntityDamageEvent::CAUSE_VOID) {
                $this->game->broadcastMessage(new MessageContainer("PLAYER_WAS_KNOCKED_INTO_THE_VOID", $arguments));
            } else {
                $this->game->broadcastMessage(new MessageContainer("PLAYER_WAS_KILLED_BY_PLAYER", $arguments));
            }
        }

        if($cause === EntityDamageEvent::CAUSE_VOID and $killerSession === null) {
            $this->game->broadcastMessage(new MessageContainer("PLAYER_FELL_TO_THE_VOID", [
                "player" => $username
            ]));
        }

        $this->game->broadcastActionBar(new MessageContainer("PLAYERS_REMAINING", [
            "count" => $this->game->getPlayersCount()
        ]));

        $this->player->getEffects()->clear();
        $this->player->teleport($this->game->getMap()->getSpectatorSpawnPosition());
        $this->player->setGamemode(GameMode::SPECTATOR);

        if(!$this->game->getStage() instanceof EndingStage) {
            $this->game->removePlayer($this, false, true);

            $this->sendTitle(new MessageContainer("YOU_DIED_TITLE"), new MessageContainer("YOU_DIED_SUBTITLE"), 0, 100, 0);
        } else {
            $this->clearInventories();
        }
    }

    public function playSound(Sound $sound): void 
    {
        $this->player->broadcastSound($sound, [$this->player]);
    }

    public function sendDataPacket(ClientboundPacket $packet): void 
    {
        $this->player->getNetworkSession()->sendDataPacket($packet);
    }

    public function sendTitle(MessageContainer $title, ?MessageContainer $subtitle = null, int $fadeIn = -1, int $stay = -1, int $fadeOut = -1): void 
    {
        $this->player->sendTitle($title->getMessage(), $subtitle !== null ? $subtitle->getMessage() : "", $fadeIn, $stay, $fadeOut);
    }

    public function sendActionBar(MessageContainer $container): void 
    {
        $this->player->sendActionBarMessage($container->getMessage());
    }

    public function sendPopup(MessageContainer $container): void 
    {
        $this->player->sendPopup($container->getMessage());
    }

    public function sendMessage(MessageContainer $container): void 
    {
        $this->player->sendMessage($container->getMessage());
    }
    
}