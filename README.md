# 说明
> hyperf/elasticsearch
默认安装的es版本是6.8，如果要改成7.4以上版本，
需要卸载原先的elasticsearch/elasticsearch php包，
然后修改  composer.lock里面 hyperf/elasticsearch 锁定的elasticsearch/elasticsearch php包版本为7以上即可安装 elasticsearch/elasticsearch 高版本

> elasticsearch/elasticsearch

高版本需要集群模式,如果是单个es，会提示 $response['transfer_stats']['primary_port'] primary_port没有此值,可以忽略