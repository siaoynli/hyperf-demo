<?php

declare(strict_types=1);

namespace App\Event;


class UserRegistered
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        echo "------" . $this->message . "\n";
        return $this->message;
    }
}
