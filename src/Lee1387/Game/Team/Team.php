<?php

declare(strict_types=1);

namespace Lee1387\Game\Team;

use pocketmine\math\Vector3;
use Lee1387\Session\Session;
use function in_array;

class Team 
{

    use TeamProperties;

    private int $slots;

    /** @var Session[] */
    private array $members = [];

    public function __construct(string $name, Vector3 $spawnPoint, int $slots) 
    {
        $this->name = $name;
        $this->spawnPoint = $spawnPoint;
        $this->slots = $slots;
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

    public function isFull(): bool 
    {
        return $this->getMembersCount() >= $this->slots;
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
        $session->getPlayer()->setNameTag($this->getColoredName() . $this->getFirstLetter() . " " . $session->getUsername());
    }

    public function removeMember(Session $session): void 
    {
        unset($this->members[array_search($session, $this->members, true)]);

        $session->setTeam(null);
        $session->getPlayer()->setNameTag($session->getUsername());
    }

    public function reset(): void 
    {
        foreach($this->members as $member) {
            $this->removeMember($member);
        }
    }
    
}