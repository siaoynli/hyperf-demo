<?php
$table = new Swoole\Table(1024);
$table->column('fd', Swoole\Table::TYPE_INT);
$table->column('reactor_id', Swoole\Table::TYPE_INT);
$table->column('data', Swoole\Table::TYPE_STRING, 64);
$table->create();

$ws = new Swoole\WebSocket\Server("0.0.0.0", 9501);

$ws->set([
    "enable_static_handler" => true,
    "document_root" => "/hyperf-skeleton/swoole/table"

]);

$ws->set(['dispatch_mode' => 1]);
$ws->table = $table;

$ws->on("open", function ($ws, $request) {
    // var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "hello, welcome\n");
});

$ws->on("message", function ($ws, $frame) {

    $cmd = explode(" ", trim($frame->data));

    //get
    if ($cmd[0] == 'get') {
        //get self
        if (count($cmd) < 2) {
            $cmd[1] = $frame->fd;
        }
        $get_fd = intval($cmd[1]);
        $info = $ws->table->get($get_fd);
        $ws->push($frame->fd, var_export($info, true) . "\n");
    }
    //set
    elseif ($cmd[0] == 'set') {
        $ret = $ws->table->set($frame->fd, array('reactor_id' => $frame->data, 'fd' => $frame->fd, 'data' => $cmd[1]));
        if ($ret === false) {
            $ws->push($frame->fd, "ERROR\n");
        } else {
            $ws->push($frame->fd, "set OK\n");
        }
    } else {
        $ws->push($frame->fd, "command error.\n");
    }

    // $ws->push($frame->fd, "server回复: {$frame->data}");
});

// $ws->on('close', function ($ws, $fd) {
//     echo "client-{$fd} is closed\n";
// });

$ws->start();
