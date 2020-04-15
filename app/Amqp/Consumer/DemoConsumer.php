<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;


//默认情况下，使用了 @Consumer 注解后，框架会自动创建子进程启动消费者，并且会在子进程异常退出后，重新拉起。 如果出于开发阶段，进行消费者调试时，可能会因为消费其他消息而导致调试不便。
// 这种情况，只需要在 @Consumer 注解中配置 enable=false (默认为 true 跟随服务启动)或者在对应的消费者中重写类方法 isEnable() 返回 false 即可
/**
 * @Consumer(exchange="hyperf", routingKey="hyperf", queue="hyperf", name ="DemoConsumer", nums=1)
 */
class DemoConsumer extends ConsumerMessage
{
    public function consume($data): string
    {
        echo "消费信息:\n";
        print_r($data);
        echo "\n";
        return Result::ACK;
    }
}
