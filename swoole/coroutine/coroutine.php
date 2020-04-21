<?php

declare(strict_types=1);
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-21 15:27:26
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-21 15:40:59
 * @Description: 
 */

use Swoole\Coroutine\Redis;
use Swoole\Coroutine\MySQL;

// Swoole\Coroutine::set(['hook_flags' => SWOOLE_HOOK_TCP]);

Swoole\Coroutine\run(function () {
    /*   Swoole\Coroutine::create(function () { */
    $redis = new Redis();
    $redis->connect("host.docker.internal", 6379);
    $redis->set("hahaa", "hello");
    var_dump($redis->get("hahaa"));
    $mysql = new MySQL();
    $mysql->connect(["host" => "host.docker.internal", "port" => 3306, "database" => "hyperf", "user" => "root", "password" => "root"]);
    $result = $mysql->query("select * from users order by id desc limit 1");
    var_dump($result);
    // });
});
