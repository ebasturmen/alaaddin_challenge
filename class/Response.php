<?php

class Response
{
    function message($message, $statusCode, $result = [], $isDie = false)
    {
        http_response_code($statusCode);
        echo json_encode(
            [
                "status" => $statusCode,
                "message" => $message,
                "result" => $result
            ]
        );

        if ($isDie){
            die();
        }
    }
}


$response = new Response();