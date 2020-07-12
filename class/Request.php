<?php
require_once 'Response.php';

class Request extends Response
{
    const POST = "POST";
    const GET = "GET";
    const PUT = "PUT";
    const DELETE = "DELETE";

    function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] !== self::POST) {
            $this->message('Request method POST olmalıdır.', 400, [], true);
        }
    }

    function isPut()
    {
        if ($_SERVER['REQUEST_METHOD'] !== self::PUT) {
            $this->message('Request method PUT olmalıdır.', 400, [], true);
        }
    }

    function isGet()
    {
        if ($_SERVER['REQUEST_METHOD'] !== self::GET) {
            $this->message('Request method GET olmalıdır.', 400, [], true);
        }
    }

    function isDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== self::DELETE) {
            $this->message('Request method DELETE olmalıdır.', 400, [], true);
        }
    }
}

$request = new Request();