<?php


class Ws
{
    CONST HOST = "0.0.0.0";
    CONST PORT = 8812;

    public $ws = null;

    public function __construct()
    {
        $this->ws = $ws = new Swoole\WebSocket\Server(self::HOST, self::PORT);

        $this->ws->set(
            [
                'enable_static_handler' => true,
                'document_root' => '/var/www/swoole/data',
            ]
        );

        $this->ws->on("open", [$this, "onOpen"]);
        $this->ws->on("message", [$this, "onMessage"]);
        $this->ws->on("close", [$this, "onClose"]);

        $this->ws->start();
    }

    // 监听WebSocket连接打开事件
    public function onOpen($ws, $request)
    {
        echo $request->fd . "\n";
    }

    // 监听WebSocket消息事件
    public function onMessage($ws, $frame)
    {
        echo "Message: {$frame->data}-{$frame->fd}\n";
        $ws->push($frame->fd, "server: i am server" . date("Y-m-d H:i:s"));
    }

    // 监听WebSocket连接关闭事件
    public function onClose($ws, $fd)
    {
        echo "client-{$fd} is closed\n";
    }

}

(new Ws());