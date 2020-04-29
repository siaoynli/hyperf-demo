<?php

declare(strict_types=1);
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-21 11:03:04
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-21 11:59:54
 * @Description: 
 */

Swoole\Coroutine\run(function () {
    $redis = new Swoole\Coroutine\Redis();
    $redis->connect('host.docker.internal', 6379);

    $redis->set("lo", "123456");
});
