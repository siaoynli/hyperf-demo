<?php

declare(strict_types=1);


namespace App\Listener;

use App\Event\UserRegistered;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;

//ampq消费队列
use Hyperf\Amqp\Producer;
use App\Amqp\Producer\DemoProducer;
use Hyperf\Utils\ApplicationContext;

//通过注解注册监听器时，我们可以通过设置 priority 属性定义当前监听器的顺序，如 @Listener(priority=1) ，底层使用 SplPriorityQueue 结构储存，priority 数字越大优先级越高。
//在定义完监听器之后，我们需要让其能被 事件调度器(Dispatcher) 发现，可以在 config/autoload/listeners.php 配置文件 内添加该监听器即可
/**
 * @Listener
 */
class UserRegisteredListener implements ListenerInterface
{
    public function listen(): array
    {
        // 返回一个该监听器要监听的事件数组，可以同时监听多个事件
        return [
            UserRegistered::class,
        ];
    }

    /**
     * @param UserRegistered $event
     */
    public function process(object $event)
    {
        // 事件触发后该监听器要执行的代码写在这里，比如该示例下的发送用户注册成功短信等
        // 直接访问 $event 的 user 属性获得事件触发时传递的参数值
        // $event->user;
        $message = $event->getMessage();
        echo  '获取到信息:' . $message . "\n";
        /*  $message = new DemoProducer($message);
        $producer = ApplicationContext::getContainer()->get(Producer::class);
        echo  '生产:' . $result = $producer->produce($message) . "\n"; */
    }
}
