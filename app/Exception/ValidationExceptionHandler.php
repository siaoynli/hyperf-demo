<?php

namespace App\Exception;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Hyperf\Validation\ValidationException;
use Throwable;

class ValidationExceptionHandler extends  ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {

        // 判断被捕获到的异常是希望被捕获的异常
        if ($throwable instanceof ValidationException) {
            // 格式化输出
            $data = json_encode(
                //返回所有错误信息
                // $throwable->validator->errors(),
                //返回第一条错误信息
                ["message" => $throwable->validator->errors()->first()],
                JSON_UNESCAPED_UNICODE
            );

            // 阻止异常冒泡
            $this->stopPropagation();
            // return $response->withStatus($throwable->status)->withBody(new SwooleStream($data));
            return $response->withStatus(200)->withBody(new SwooleStream($data));
        }

        // 交给下一个异常处理器
        return $response;

        // 或者不做处理直接屏蔽异常
    }

    /**
     * 判断该异常处理器是否要对该异常进行处理
     */
    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
