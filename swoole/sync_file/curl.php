<?php

declare(strict_types=1);
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-21 10:45:15
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-21 10:48:17
 * @Description: 
 */


Swoole\Coroutine::set(['hook_flags' => SWOOLE_HOOK_CURL]);

Swoole\Coroutine\run(function () {
    Swoole\Coroutine::create(function () {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.baidu.com/");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        $fp = fopen("test.html", "a+");
        fwrite($fp, $result);
        curl_close($ch);
        fclose($fp);
    });
    echo "here" . PHP_EOL;
});
