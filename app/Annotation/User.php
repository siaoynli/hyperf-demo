<?php

declare(strict_types=1);
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-22 16:50:12
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-22 17:11:53
 * @Description: 
 */

namespace App\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;

// 自定义注解类
// @Target 有如下参数：
// METHOD 注解允许定义在类方法上
// PROPERTY 注解允许定义在类属性上
// CLASS 注解允许定义在类上
// ALL 注解允许定义在任何地方

/**
 * @Annotation
 * @Target("METHOD") 
 */
class User extends AbstractAnnotation
{
    /**
     * @var string
     */
    public $name;
}
