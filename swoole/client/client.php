<?php


$client = new Swoole\Client(SWOOLE_SOCK_TCP);

$client->set(array(
    'timeout' => 0.5,
    'connect_timeout' => 1.0,
    'write_timeout' => 10.0,
    'read_timeout' => 0.5,
));

if (!$client->connect('127.0.0.1', 9503, 0.5)) {
    echo "connect failed. Error: {$client->errCode}\n";
}

fwrite(STDIN, "请输入数据:");
$data = trim(fgets(STDIN));

$client->send($data . "\n");
echo $client->recv();
$client->close();
