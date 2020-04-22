<?php
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-15 10:56:36
 * @Description: 
 */

/********************************************* */
// 此处代码示例为每个示例都提供了三种不同的绑定定义方式，实际配置时仅可采用一种且仅定义一次相同的路由
// 设置一个 GET 请求的路由，绑定访问地址 '/get' 到 App\Controller\IndexController 的 get 方法
// Router::get('/get', 'App\Controller\IndexController::get');
// Router::get('/get', 'App\Controller\IndexController@get');
// Router::get('/get', [\App\Controller\IndexController::class, 'get']);

// // 设置一个 POST 请求的路由，绑定访问地址 '/post' 到 App\Controller\IndexController 的 post 方法
// Router::post('/post', 'App\Controller\IndexController::post');
// Router::post('/post', 'App\Controller\IndexController@post');
// Router::post('/post', [\App\Controller\IndexController::class, 'post']);

// // 设置一个允许 GET、POST 和 HEAD 请求的路由，绑定访问地址 '/multi' 到 App\Controller\IndexController 的 multi 方法

// Router::addRoute(['GET', 'POST', 'HEAD'], '/multi', 'App\Controller\IndexController::multi');
// Router::addRoute(['GET', 'POST', 'HEAD'], '/multi', 'App\Controller\IndexController@multi');
// Router::addRoute(['GET', 'POST', 'HEAD'], '/multi', [\App\Controller\IndexController::class, 'multi']);
/********************************************* */

declare(strict_types=1);

use App\Middleware\AuthMiddleware;
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index', ['middleware' => [AuthMiddleware::class]]);

Router::get('/oss', 'App\Controller\IndexController@aliyun');
Router::get('/form', 'App\Controller\IndexController@form');
Router::get('/session', 'App\Controller\IndexController@session');
Router::get('/cache', 'App\Controller\IndexController@cache');
Router::get('/demo', 'App\Controller\IndexController@demo');


Router::get('/ws', 'App\Controller\IndexController@WebSocket');
Router::get('/user/index/{id}', 'App\Controller\UserController@index');
Router::get('/user/{id}', 'App\Controller\UserController@getId');




//websocket

Router::addServer('ws', function () {
    Router::get('/ws', 'App\Controller\WebSocketController');
});
