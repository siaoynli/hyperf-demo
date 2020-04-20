<?php
/*
* @Author: lixiaoyun
* @Company: http://hangzhou.com.cn
* @Github: http://github.com/siaoynli
* @Date: 2020-04-20 13:38:18
* @Description:
*/
$http = new Swoole\Http\Server("0.0.0.0", 9501);

$http->set([
    "enable_static_handler" => true,
    "document_root" => "/hyperf-skeleton/public"

]);

$http->on('request', function ($request, $response) {
    /*  var_dump($request->get, $request->post); */
    $response->cookie("lee", "123456", time() + 1800);
    $response->header("Content-Type", "text/html; charset=utf-8");
    $response->end("<h1>Hello Swoole. #" . rand(1000, 9999) . "</h1>");
});

$http->start();
