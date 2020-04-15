<?php

declare(strict_types=1);


namespace App\Services;


use App\Event\UserRegistered;
use Hyperf\Di\Annotation\Inject;
use Psr\EventDispatcher\EventDispatcherInterface;

class UserService
{


    /**
     * @Inject 
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function getById()
    {
        return "by userService";
    }

    public function sendMessage()
    {
        // 我们假设存在 User 这个实体
        $sendMessage = "我发送信息了";
        $this->eventDispatcher->dispatch(new UserRegistered($sendMessage));
        return true;
    }
}
