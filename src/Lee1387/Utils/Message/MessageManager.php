<?php

declare(strict_types=1);

namespace Lee1387\Utils\Message;

use Lee1387\SkyWars;
use Lee1387\Utils\ColorUtils;
use function json_decode;

class MessageManager 
{

    /** @var string[] */
    private array $messages;

    public function __construct() 
    {
        $this->messages = json_decode(file_get_contents(SkyWars::getInstance()->getDataFolder() . "messages.json"), true);
    }

    public function getMessage(MessageContainer $container): string 
    {
        $identifier = $container->getId();
        $message = $this->messages[$identifier] ?? "Message ($identifier) not found";
        foreach($container->getArguments() as $key => $value) {
            $message = str_replace("{" . $key . "}", (string) $value, $message);
        }
        return ColorUtils::translate($message);
    }

    public function addMessage(string $identifier, string $message): void 
    {
        $this->messages[$identifier] = $message;
    }
}