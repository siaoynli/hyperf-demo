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
use App\Model\User;
use App\Request\UserRequest;
use App\Services\Cache\DemoService;
use App\Services\Cache\UserCacheService;

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

use App\Services\UserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CachePut;
use Hyperf\HttpServer\Annotation\Controller;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

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

    //依赖注入注解
    /**
     * @Inject()
     * @var UserCacheService
     */
    private $cacheService;

    //todo:首次查询时，会从数据库中查，后面查询时，会从缓存中查。
    /**
     * @Cacheable(prefix="user", ttl=1000,value="_#{id}",listener="USER_CACHE")
     */
    public function index($id = 10)
    {
        $user = User::where("id", $id)->first();
        if ($user) {

            return $user->toArray();
        }
        return ["user" =>  $user];
    }


    //更新数据同时更新缓存
    /**
     * @CachePut(prefix="user", ttl=1000)
     * @RequestMapping(path="update",methods="get")
     */
    public function update()
    {
        $user = User::first();
        $user->name = 'HyperfDoc_' . time();
        $user->save();
        return  $user;
    }


    /**
     * @RequestMapping(path="delete",methods="get")
     */
    public function delete()
    {
        $user = User::first();
        // $this->cacheService->flushCache($user->id);
        $user->delete();
        return  $this->cacheService->flushCache($user->id);
    }


    /**
     * @RequestMapping(path="all",methods="get")
     * @Cacheable(prefix="users", ttl=1000,listener="USERS_CACHE")
     */
    public function all()
    {
        $users = User::query()->get();
        if ($users) {

            return $users->toArray();
        }
        return ["users" =>  $users];
    }


    /**
     * @RequestMapping(path="deleteAll",methods="get")
     */
    public function deleteAll()
    {
        return  $this->cacheService->flushAllCache();
    }




    public function getId(int $id)
    {
        //todo:可选参数 没测试通过
        // $id = $request->route('id', 1);
        $user = User::query()->where("id", $id)->first();
        return ["user" => $user];
    }


    //访问路径  /user/show?id=1
    /**
     * //todo:注解路由path传变量不清楚怎么写
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

    /**
     * @RequestMapping(path="create",methods="get")
     */
    public  function create(UserRequest $request)
    {
        $validated = $request->validated();
        $name = $request->input("name", "Hyperf");
        $user = new User();
        $user->name =  $name . '_' . time();
        $user->password = "123456";
        $user->save();
        return $user;
    }
}
