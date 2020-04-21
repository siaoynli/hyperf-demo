<?php

declare(strict_types=1);
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-21 10:50:47
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-21 10:53:25
 * @Description: 
 */

Swoole\Coroutine\run(function () {
    $swoole_mysql = new Swoole\Coroutine\MySQL();
    $swoole_mysql->connect([
        'host'     => 'host.docker.internal',
        'port'     => 3306,
        'user'     => 'root',
        'password' => 'root',
        'database' => 'hyperf',
    ]);
    $res = $swoole_mysql->query('select * from users order by id desc  limit 1');
    var_dump($res);
});
