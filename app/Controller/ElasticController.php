<?php

declare(strict_types=1);
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-29 14:35:28
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-29 16:35:42
 * @Description: 
 */

namespace App\Controller;


use Hyperf\Di\Container;
use App\Request\UserRequest;
use Hyperf\Di\Annotation\Inject;
use Hyperf\View\RenderInterface;
use Hyperf\Elasticsearch\ClientBuilderFactory;

class ElasticController extends AbstractController
{
    public function index()
    {
        $builder = $this->container->get(ClientBuilderFactory::class)->create();


        $client = $builder->setHosts(['http://host.docker.internal:9200'])->build();

        // $info = $client->info();


        //创建
        $params = [
            'index' => 'kuangshenshuo',
            'id'    => 1,
            'body'  => ['name' => '狂神说java']
        ];
        $response = $client->index($params);

        //获取
        /*       $params = [
            'index' => 'kuangshenshuo2',
            // 'type' => "_doc",
            'id'    => 1
        ];
        $response = $client->get($params); */

        //获取资源
        /*   $params = [
            'index' => 'kuangshenshuo',
            'type' => "_doc",
            'id'    => 1
        ];
        $response = $client->getSource($params); */

        // $params = [
        //     'index' => 'kuangshenshuo',
        //     'body'  => [
        //         'query' => [
        //             'match' => [
        //                 'name' => '狂神说'
        //             ]
        //         ]
        //     ]
        // ];

        // $response = $client->search($params);

        // var_dump($response);

        return $response;
    }
}
