<?php

declare(strict_types=1);

namespace Lee1387\Session\Scoreboard\Layout;

use Lee1387\Session\Session;
use Lee1387\Utils\Message\MessageContainer;

interface Layout 
{

    public function getMessageContainer(Session $session): MessageContainer;
    
}