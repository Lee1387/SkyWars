<?php

declare(strict_types=1);

namespace Lee1387\Session\Scoreboard;

use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use Lee1387\Session\Session;
use Lee1387\Utils\ColorUtils;
use Lee1387\Utils\Message\MessageContainer;

abstract class Scoreboard 
{

    protected Session $session;

    protected string $title;
    protected string $ip;

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->title = (new MessageContainer("SCOREBOARD_TITLE"))->getMessage();
        $this->ip = (new MessageContainer("SCOREBOARD_IP"))->getMessage();

        $this->show();
    }

    public function show(): void 
    {
        if($this->session->isConnected()) {
            $this->hide();

            $packet = new SetDisplayObjectivePacket();
            $packet->displaySlot = SetDisplayObjectivePacket::DISPLAY_SLOT_SIDEBAR;
            $packet->objectiveName = $this->session->getUsername();
            $packet->displayName = $this->title;
            $packet->criteriaName = "dummy";
            $packet->sortOrder = SetDisplayObjectivePacket::SORT_ORDER_DESCENDING;
            $this->session->sendDataPacket($packet);

            foreach($this->getLines() as $score => $line) {
                $this->addLine($score, " " . $line);
            }
            $this->addLine(2, " ");
            $this->addLine(1, " ", $this->ip);
        }
    }

    private function addLine(int $score, string $text): void 
    {
        $entry = new ScorePacketEntry();
        $entry->objectiveName = $this->session->getUsername();
        $entry->type = ScorePacketEntry::TYPE_FAKE_PLAYER;
        $entry->customName = ColorUtils::translate($text);
        $entry->score = $score;
        $entry->scoreboardId = $score;
        $packet = new SetScorePacket();
        $packet->type = SetScorePacket::TYPE_CHANGE;
        $packet->entries[] = $entry;
        $this->session->sendDataPacket($packet);
    }

    private function hide(): void 
    {
        if($this->session->isConnected()) {
            $packet = new RemoveObjectivePacket();
            $packet->objectiveName = $this->session->getUsername();
            $this->session->sendDataPacket($packet);
        }
    }

    /**
     * @return string[]
     */
    abstract protected function getLines(): array;
    
}