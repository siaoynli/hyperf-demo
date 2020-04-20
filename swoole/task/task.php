<?php
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-20 15:59:17
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-20 16:37:56
 * @Description: 
 */



class Ws
{
    private $ws = null;

    function __construct($host = "0.0.0.0", $port = 9501)
    {
        $this->ws = new Swoole\WebSocket\Server($host, $port);
        $this->ws->set([
            "enable_static_handler" => true,
            "document_root" => "/hyperf-skeleton/swoole/websocket",
            'task_worker_num' => 4,
        ]);

        $this->ws->on("open", [$this, "onOpen"]);
        $this->ws->on("task", [$this, "onTask"]);
        $this->ws->on("finish", [$this, "onFinish"]);
        $this->ws->on("message", [$this, "onMessage"]);
        $this->ws->on("close", [$this, "onClose"]);
        $this->ws->start();
    }


    function onOpen(Swoole\WebSocket\Server $ws, $request)
    {
        var_dump($request->fd, $request->get, $request->server);
        $ws->push($request->fd, "hello, welcome\n");
    }

    function onMessage(Swoole\WebSocket\Server $ws, $frame)
    {
        echo "Message: {$frame->data}\n";
        $data = [
            "task" => 1,
            "fd" => $frame->fd,
        ];
        $ws->task($data);
        $ws->push($frame->fd, "server回复: {$frame->data}");
    }

    function onClose($ws, $fd)
    {
        echo "client-{$fd} is closed\n";
    }

    function onTask($ws,  int $task_id, int $src_worker_id,  $data)
    {
        print_r($data);

        sleep(10);

        return "on task finish";
    }

    function onFinish($ws, int $task_id, string $data)
    {
        echo "taskId:" . $task_id . "\n";
        echo "finish success:" . $data;
    }
}

$ws = new Ws();
