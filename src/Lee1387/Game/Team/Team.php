<?php

declare(strict_types=1);

namespace Lee1387\Game\Team;

use pocketmine\math\Vector3;
use pocketmine\player\GameMode;
use pocketmine\world\Position;
use Lee1387\Session\Session;
use function in_array;

class Team 
{

    use TeamProperties;

    /** @var Session[] */
    private array $members = [];

    public function __construct(string $name, Vector3 $spawnPoint) 
    {
        $this->name = $name;
        $this->spawnPoint = $spawnPoint;
    }

    public function getColoredName(): string 
    {
        return $this->getColor() . $this->getName();
    }

    public function getFirstLetter(): string 
    {
        return $this->name[0];
    }

    /**
     * @return Session[]
     */
    public function getMembers(): array 
    {
        return $this->members;
    }

    public function getMembersCount(): int 
    {
        return count($this->members);
    }

    public function isAlive(): bool 
    {
        return $this->getMembersCount() > 0;
    }

    public function hasMember(Session $session): bool 
    {
        return in_array($session, $this->members, true);
    }

    public function addMember(Session $session): void 
    {
        $this->members[] = $session;

        $session->setTeam($this);
        $session->clearInventories();
        // todo: give kit, apply perks, etc.

        $player = $session->getPlayer();
        $player->setNameTag($this->getColoredName() . $this->getFirstLetter() . " " . $player->getName());
        $player->setGamemode(GameMode::SURVIVAL);
        $player->teleport(Position::fromObject($this->spawnPoint, $session->getGame()->getWorld()));
    }

    public function removeMember(Session $session): void 
    {
        unset($this->members[array_search($session, $this->members, true)]);

        $session->setTeam(null);
    }

    public function reset(): void 
    {
        foreach($this->members as $member) {
            $this->removeMember($member);
        }
    }
    
}