<?php

declare(strict_types=1);
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-29 14:35:28
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-29 17:35:02
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

        //docker
        //$client = $builder->setHosts(['http://host.docker.internal:9200'])->build();

        //阿里云

        $client = $builder->setHosts([
            [
                'host' => 'es-cn-zo21molzq0001f2hr.public.elasticsearch.aliyuncs.com',
                'port' => '9200',
                'path' => '',
                'scheme' => 'http',
                'user' => 'elastic',
                'pass' => 'HZ@lxyztx386'
            ]
        ])->build();


        // $response = $client->info();

        //创建索引
        /*       $params = [
            'index' => 'kuangshenshuo',
            'body'  => [
                'settings' => [
                    'number_of_shards' => 5, //分片数
                    'number_of_replicas' => 1 //副本数
                ]
            ]
        ];

        $response = $client->indices()->create($params);
 */
        //创建索引，初始化
        $params = [
            'index' => 'my_index',
            'body' => [
                'settings' => [
                    'number_of_shards' => 3,
                    'number_of_replicas' => 2
                ],
                'mappings' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'first_name' => [
                            'type' => 'keyword'
                        ],
                        'age' => [
                            'type' => 'integer'
                        ]
                    ]
                ]
            ]
        ];
        // Create the index with mappings and settings now
        $response = $client->indices()->create($params);

        //添加文档
        /*    $params = [
            'index' => 'kuangshenshuo',
            'id'    => 1,
            'body'  => ['name' => '狂神说java']
        ];
        $response = $client->index($params); */




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
