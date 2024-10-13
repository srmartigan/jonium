<?php

namespace Core\Exceptions;

use Exception;
class HttpException extends Exception
{
    public function __construct($message = "Internal server Error", $status_http_code = 500, Exception $previous = null){
        parent::__construct($message, $status_http_code, $previous);
    }
}
