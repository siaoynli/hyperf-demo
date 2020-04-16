<?php

declare(strict_types=1);

namespace App\Services\Cache;


use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CacheEvict;

class DemoService
{
    //value #前面随意填写 括号里面的变量和函数传进来的变量相同
    /**
     * @Cacheable(prefix="user",ttl=2000, value="_#{model.id}")
     */
    public function getCache($model)
    {
        return $model;
    }

    /**
     * @CacheEvict(prefix="user", value="_#{id}")
     */
    public function clearCache(int $id)
    {
        return true;
    }
}
