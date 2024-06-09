<?php

declare(strict_types=1);

namespace Lee1387\Utils\Message;

use Lee1387\SkyWars;

class MessageContainer 
{

    private string $id;
    private array $arguments;

    public function __construct(string $id, array $arguments = []) 
    {
        $this->id = $id;
        $this->arguments = $arguments;
    }

    public function getId(): string 
    {
        return $this->id;
    }

    public function getArguments(): array 
    {
        return $this->arguments;
    }

    public function getMessage(): string 
    {
        return SkyWars::getInstance()->getMessageManager()->getMessage($this);
    }
}