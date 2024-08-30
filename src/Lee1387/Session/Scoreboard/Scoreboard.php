<?php

declare(strict_types=1);

namespace Lee1387\Session\Scoreboard;

use Lee1387\Session\Scoreboard\Layout\Layout;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use Lee1387\Session\Session;
use Lee1387\Utils\ColorUtils;
use Lee1387\Utils\Message\MessageContainer;

class Scoreboard 
{

    private Session $session;
    private Layout $layout;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function setLayout(Layout $layout): void {
        $this->layout = $layout;
        $this->update();
    }

    public function update(): void {
        $this->hide();
        $this->display();
        $this->displayMessages();
    }

    private function hide(): void {
        $packet = new RemoveObjectivePacket();
        $packet->objectiveName = $this->session->getUsername();
        $this->session->sendDataPacket($packet);
    }

    private function display(): void {
        $packet = new SetDisplayObjectivePacket();
        $packet->displaySlot = SetDisplayObjectivePacket::DISPLAY_SLOT_SIDEBAR;
        $packet->objectiveName = $this->session->getUsername();
        $packet->displayName = (new MessageContainer("SCOREBOARD_TITLE"))->getMessage();
        $packet->criteriaName = "dummy";
        $packet->sortOrder = SetDisplayObjectivePacket::SORT_ORDER_DESCENDING;
        $this->session->sendDataPacket($packet);
    }

    private function displayMessages(): void {
        $messages = $this->layout->getMessageContainer($this->session)->getMessage();
        foreach ($messages as $index => $message) {
            $this->setLine(count($messages) - $index, $message);
        }
    }

    private function setLine(int $score, string $text): void {
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
    
}