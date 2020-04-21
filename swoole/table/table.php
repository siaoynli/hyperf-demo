<?php

declare(strict_types=1);
/*
 * @Author: lixiaoyun
 * @Company: http://hangzhou.com.cn
 * @Github: http://github.com/siaoynli
 * @Date: 2020-04-21 14:34:31
 * @LastEditors: lixiaoyun
 * @LastEditTime: 2020-04-21 15:06:44
 * @Description: 
 */

$table = new Swoole\Table(1024);
$table->column('id', Swoole\Table::TYPE_INT, 4);       //1,2,4,8
$table->column('name', Swoole\Table::TYPE_STRING, 64);
$table->column('num', Swoole\Table::TYPE_FLOAT);
$table->create();

//singwa_imooc类似表名
$table->set("singwa_imooc", ["id" => 1, "name" => "lee", "num" => 10]);

var_dump($table->get("singwa_imooc"));
