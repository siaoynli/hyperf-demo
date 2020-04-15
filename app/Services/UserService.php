<?php
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-15 11:23:02
 * @Description: 
 */

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


    public function sendMessage()
    {

        $sendMessage = "register";
        $this->eventDispatcher->dispatch(new UserRegistered($sendMessage));
    }
}
