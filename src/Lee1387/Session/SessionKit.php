<?php

declare(strict_types=1);

namespace Lee1387\Session;

use Lee1387\Game\Difficulty;
use Lee1387\Game\Kit\Kit;

class SessionKit 
{

    private Kit $kit;
    private Difficulty $difficulty;

    public function __construct(Kit $kit, Difficulty $difficulty) 
    {
        $this->kit = $kit;
        $this->difficulty = $difficulty;
    }

    public function getKit(): Kit 
    {
        return $this->kit;
    }

    public function getDifficulty(): Difficulty 
    {
        return $this->difficulty;
    }
    
}