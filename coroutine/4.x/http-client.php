<?php

// 接口
// http://127.0.0.1:8000/api/v1/banner/1

Co\run(function (){
    $cli = new Swoole\Coroutine\Http\Client('127.0.0.1', 8000);

    $cli->set(
        [
            'timeout' => 3.0
        ]
    );

    $cli->get('/api/v1/banner/1');
    echo $cli->body;
    // 状态码
    echo $cli->statusCode;
    $cli->close();
});
