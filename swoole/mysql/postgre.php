<?php

declare(strict_types=1);
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-21 10:53:55
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-21 10:55:26
 * @Description: 
 */

Swoole\Coroutine\run(function () {
    $pg = new Swoole\Coroutine\PostgreSQL();
    $conn = $pg->connect("host=host.docker.internal port=5432 dbname=demo user=postgres password=postgres");
    if (!$conn) {
        var_dump($pg->error);
        return;
    }
    $result = $pg->query('SELECT * FROM users;');
    $arr = $pg->fetchAll($result);
    var_dump($arr);
});
