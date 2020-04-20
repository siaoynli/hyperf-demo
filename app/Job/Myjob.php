<?php


/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-16 09:36:23
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-20 15:36:07
 * @Description: 
 */

declare(strict_types=1);


namespace App\Job;

use Hyperf\AsyncQueue\Job;

class Myjob extends Job
{
    public function __construct()
    {
    }

    public function handle()
    {
    }
}
