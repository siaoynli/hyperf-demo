<?php

declare(strict_types=1);
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-21 10:19:05
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-21 10:44:31
 * @Description: 
 */

//hooks 需要在协程容器里面使用
Swoole\Coroutine::set(['hook_flags' => SWOOLE_HOOK_FILE]);

//协程容器
Swoole\Coroutine\run(function () {
    Swoole\Coroutine::create(function () {
        $fp = fopen("test.log", "a+");
        fwrite($fp, str_repeat('A', 2048));
        fwrite($fp, str_repeat('B', 2048));
    });
    echo "here" . PHP_EOL;
});
