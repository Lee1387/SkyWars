<?php

declare(strict_types=1);

namespace Lee1387\Utils\Message;

use Lee1387\SkyWars;
use Lee1387\Utils\ColorUtils;
use function array_map;
use function is_array;
use function json_decode;
use function str_replace;

class MessageManager 
{

    /** @var string[] */
    private array $messages;

    public function __construct() 
    {
        $this->messages = json_decode(file_get_contents(SkyWars::getInstance()->getDataFolder() . "messages.json"), true);
    }

    public function getMessage(MessageContainer $container): string|array 
    {
        $identifier = $container->getId();
        $arguments = $container->getArguments();

        $message = $this->messages[$identifier] ?? "Message ($identifier) not found";
        if (is_array($message)) {
            return $this->processMessages($message, $arguments);
        }
        return $this->processMessage($message, $arguments);
    }

    private function processMessages(array $messages, array $arguments): array 
    {
        return array_map(fn(string $message) => $this->processMessage($message, $arguments), $messages);
    }

    private function processMessage(string $message, array $arguments): string 
    {
        foreach ($arguments as $key => $value) {
            if ($value instanceof MessageContainer) {
                $value = $value->getMessage();
            }
            $message = str_replace("{" . $key . "}", (string) $value, $message);
        }
        return ColorUtils::translate($message);
    }

    public function addMessage(string $identifier, string $message): void
    {
        $this->messages[$identifier] = $message;
    }
    
}