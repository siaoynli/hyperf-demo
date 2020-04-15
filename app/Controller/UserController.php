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

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

/**
 * @Controller()
 */
class UserController extends AbstractController
{

    public function index()
    {
        return [
            'message' => "Hello User.",
        ];
    }

    /**
     * @RequestMapping(path="show",methods="get")
     */
    public function show(RequestInterface $request)
    {
        $id = $request->input("id", 1);
        return [
            'message' => "show User." . $id,
        ];
    }
}
