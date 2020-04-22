<?php

declare(strict_types=1);

namespace App\Aspect;

use App\Annotation\User;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Di\Aop\AbstractAspect;
use Psr\Container\ContainerInterface;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;

/**
 * @Aspect
 */
class FooAspect extends AbstractAspect
{
    protected $container;

    /**
     * @Inject
     * @var ResponseInterface
     */
    public $response;

    /**
     * @Inject
     * @var RequestInterface
     */
    public $request;


    /**
     * 切入的类
     */
    public $classes = [

        'App\Controller\IndexController::demo',
        // 'App\Service\SomeClass::*Method',
    ];

    // 要切入的注解，具体切入的还是使用了这些注解的类，仅可切入类注解和类方法注解
    public $annotations = [
        User::class,
    ];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {

        $result = $proceedingJoinPoint->process();

        //获取注解参数

        $user = $proceedingJoinPoint->getAnnotationMetadata()->method[User::class];

        var_dump($user);

        // return $this->response->withStatus(200)->withHeader()->withBody(new SwooleStream('222' . $result . 'qqq----' . $user->name . "----"));

        return $this->response->json(['message' => '登录失败', 'code' => '403']);
    }
}
