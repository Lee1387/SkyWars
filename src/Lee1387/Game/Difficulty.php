<?php

declare(strict_types=1);

namespace Lee1387\Game;

enum Difficulty 
{

    case NORMAL;
    case INSANE;

    public function getDisplayName(): string 
    {
        return match($this) {
            self::NORMAL => "Normal",
            self::INSANE => "Insane"
        };
    }
    
}