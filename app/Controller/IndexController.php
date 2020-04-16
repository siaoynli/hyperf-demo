<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\UserRequest;

use Hyperf\Di\Annotation\Inject;
use Hyperf\WebSocketClient\ClientFactory;
use Hyperf\WebSocketClient\Frame;
use Hyperf\View\RenderInterface;
use League\Flysystem\Filesystem;
use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\Utils\ApplicationContext;

class IndexController extends AbstractController
{

    /**
     * @Inject
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * @Inject()
     * @var \Hyperf\Contract\SessionInterface
     */
    private $session;


    public function index(RenderInterface $render)
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        $name = trans('messages.welcome');

        return $render->render('index', ['name' => $name]);
    }


    public function aliyun(FilesystemFactory $factory)
    {
        $local = $factory->get('oss');

        $exists =  $local->has('path/to/file.txt');

        if ($exists) {
            return   $local->delete('path/to/file.txt');;
        }
        // Write Files
        return $local->write('path/to/file.txt', 'contents');
    }


    public function form(UserRequest $request)
    {
        $validated = $request->validated();
        return "ok";
    }

    public function session()
    {
        $this->session->set('foo', 'bar');
        return ["foo" => $this->session->get('foo'), "session_id" => $this->session->getId()];
    }

    public function cache()
    {
        /*   $cache = container()->get(\Psr\SimpleCache\CacheInterface::class);
        $cache = $cache->set("name", "lee", 100); */
        return  ping();
    }


    public function WebSocket()
    {
        $host = '127.0.0.1:9502/ws';

        $autoClose = false;
        // 通过 ClientFactory 创建 Client 对象，创建出来的对象为短生命周期对象
        $client = $this->clientFactory->create($host, $autoClose);
        // 向 WebSocket 服务端发送消息
        $client->push('HttpServer 中使用 WebSocket Client 发送数据。');
        // 获取服务端响应的消息，服务端需要通过 push 向本客户端的 fd 投递消息，才能获取；以下设置超时时间 2s，接收到的数据类型为 Frame 对象。
        /** @var Frame $msg */
        $msg = $client->recv(2);
        // 获取文本数据：$res_msg->data
        return $msg->data;
    }
}
