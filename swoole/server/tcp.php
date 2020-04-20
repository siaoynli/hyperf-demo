<?php

/*
* @Author: lixiaoyun
* @Company: http://hangzhou.com.cn
* @Github: http://github.com/siaoynli
* @Date: 2020-04-20 10:10:41
* @Description:
*/


$serv = new Swoole\Server("0.0.0.0", 9503);

$serv->set([
    'worker_num' => 8,
    'max_request' => 1000,
]);

$serv->on("connect", function ($serv, $fd, $reactor_id) {
    echo "Client:content,{$fd}.线程id:{$reactor_id}.\n";
});

$serv->on("receive", function ($serv, $fd, $reactor_id, $data) {
    echo  $data . ".\n";
    $serv->send($fd, "线程id:{$reactor_id},server:" . $data);
});


$serv->on("close", function ($serv, $fd) {
    echo "Client:close.\n";
});

$serv->start();
