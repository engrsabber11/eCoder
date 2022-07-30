<?php
namespace app\core;

class Response{
    public function statusCode(int $code){
        return http_response_code($code);
    }
}