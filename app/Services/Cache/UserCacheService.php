<?php
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-15 11:23:02
 * @Description: 
 */

declare(strict_types=1);


namespace App\Services\Cache;


use Hyperf\Di\Annotation\Inject;
use Hyperf\Cache\Listener\DeleteListenerEvent;
use Psr\EventDispatcher\EventDispatcherInterface;

use Hyperf\Cache\Annotation\CacheEvict;

class UserCacheService
{

    /**
     * @Inject 
     * @var EventDispatcherInterface
     */
    private $dispatcher;


    //id 指 @Cacheable(value="_#{id}") value里的id
    public function flushCache($userId)
    {
        echo $userId . "数据更新，清空缓存\n";
        $this->dispatcher->dispatch(new DeleteListenerEvent('USER_CACHE', ['id' => $userId]));
        return true;
    }

    /**
     * @CacheEvict(prefix="user", value="_#{id}")
     */
    public function clearUser(int $id)
    {
        return true;
    }
}
