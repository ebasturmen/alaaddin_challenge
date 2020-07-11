<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/users.php';
include_once '../class/Response.php';
include_once '../class/Request.php';

$request->isPost();

try {
    $item = new User($db);
    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    $item->surname = $data->surname;
    $item->phone = $data->phone;
    $item->email = $data->email;
    $item->password = $data->password;

    if ($item->createUser()) {
        $response->message("Başarılı", 200);
    } else {
        $response->message("could not be created.", 404);
    }
} catch (Exception $exception) {
    $response->message("Bilinmeyen Bir Hata Oluştu", 500);
}
?>