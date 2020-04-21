<?php
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-20 14:48:07
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-20 16:51:36
 * @Description: 
 */

$ws = new Swoole\WebSocket\Server("0.0.0.0", 9501);

$ws->set([
    "enable_static_handler" => true,
    "document_root" => "/hyperf-skeleton/swoole/websocket"

]);


$ws->on("open", function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);

    $ws->push($request->fd, "hello, welcome\n");
});

$ws->on("message", function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    Swoole\Timer::tick(1000, function () use ($ws, $frame) {
        $ws->push($frame->fd, "server回复: {$frame->data}" . time());
    });
    $ws->push($frame->fd, "server回复111: {$frame->data}" . time());
});

$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});


$ws->start();
