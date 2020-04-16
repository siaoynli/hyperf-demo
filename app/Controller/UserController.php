<?php
/*
* @Author: lixiaoyun
* @Company: http://hangzhou.com.cn
* @Github: http://github.com/siaoynli
* @Date: 2020-04-15 11:06:16
* @Description:
*/


declare(strict_types=1);

namespace App\Controller;

//@AutoController 为绝大多数简单的访问场景提供路由绑定支持，
//使用 @AutoController 时则 Hyperf 会自动解析所在类的所有 public 方法并提供 GET 和 POST 两种请求方式。
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @Controller 为满足更细致的路由定义需求而存在，使用 @Controller 注解用于表明当前类为一个 Controller 类，同时需* *配合 @RequestMapping 注解来对请求方法和请求路径进行更详细的定义。
 *我们也提供了多种快速便捷的 Mapping 注解，如 @GetMapping、@PostMapping、@PutMapping、@PatchMapping、@DeleteMapping 5 种便捷的注解用于表明允许不同的请求方法。
 */
// 使用 @Controller 注解时需 use Hyperf\HttpServer\Annotation\Controller; 命名空间；
// 使用 @RequestMapping 注解时需 use Hyperf\HttpServer\Annotation\RequestMapping; 命名空间；
// 使用 @GetMapping 注解时需 use Hyperf\HttpServer\Annotation\GetMapping; 命名空间；
// 使用 @PostMapping 注解时需 use Hyperf\HttpServer\Annotation\PostMapping; 命名空间；
// 使用 @PutMapping 注解时需 use Hyperf\HttpServer\Annotation\PutMapping; 命名空间；
// 使用 @PatchMapping 注解时需 use Hyperf\HttpServer\Annotation\PatchMapping; 命名空间；
// 使用 @DeleteMapping 注解时需 use Hyperf\HttpServer\Annotation\DeleteMapping; 命名空间；

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Di\Annotation\Inject;

use App\Services\UserService;

/**
 * @Controller()
 */
class UserController extends AbstractController
{
    //依赖注入注解
    /**
     * @Inject()
     * @var UserService
     */
    private $userService;

    public function index()
    {

        return [
            'message' => "Hello User.",
        ];
    }


    //访问路径  /user/show?id=1
    /**
     * @RequestMapping(path="show",methods="get")
     */
    public function show(RequestInterface $request)
    {
        $id = $request->input("id", 1);

        $this->userService->sendMessage();
        return [
            'message' => "成功注册,用户id." . $id,
        ];
    }
}
