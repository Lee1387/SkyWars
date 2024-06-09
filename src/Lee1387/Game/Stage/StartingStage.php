<?php

declare(strict_types=1);

namespace Lee1387\game\Stage;

use pocketmine\world\sound\ClickSound;
use Lee1387\Game\Stage\Trait\JoinableTrait;
use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

class StartingStage extends Stage 
{

    use JoinableTrait {
        onQuit as onSessionQuit;
        tick as tickGame;
    }

    private int $countdown = 15;

    public function getCountdown(): int 
    {
        return $this->countdown;
    }

    public function onQuit(Session $session): void 
    {
        $this->onSessionQuit($session);
        $this->stopIfNotReady();
    }

    public function tick(): void 
    {
        if($this->countdown <= 0) {
            $this->game->setStage(new PlayingStage());
            return;
        }

        if($this->countdown <= 5 or $this->countdown === 10 or $this->countdown === 15) {
            $this->broadcastMessages();
        }

        $this->tickGame();
        $this->countdown--;
    }

    private function stopIfNotReady(): void 
    {
        // todo
    }

    private function broadcastMessages(): void 
    {
        if($this->countdown <= 5) {
            $this->game->broadcastTitle(new MessageContainer("LAST_COUNTDOWN_TITLE", [
                "color" => $this->getCountdownColor(),
                "time" => $this->countdown
            ]), new MessageContainer("LAST_COUNTDOWN_SUBTITLE"), 0, 21, 0);
        }

        if($this->countdown === 10) {
            $this->game->broadcastTitle(new MessageContainer("10_SECONDS_TITLE"), new MessageContainer("10_SECONDS_SUBTITLE"), 0, 20, 0);
        }

        $this->game->broadcastMessage(new MessageContainer("GAME_STARTING", [
            "color" => $this->getCountdownColor(),
            "time" => $this->countdown
        ]));
        $this->game->broadcastSound(new ClickSound());
    }

    private function getCountdownColor(): string 
    {
        return match($this->countdown) {
            15 => "{GREEN}",
            10 => "{GOLD}",
            5, 4, 3, 2, 1 => "{RED}",
            default => "{AQUA}"
        };
    }
    
}