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

/**
 * Check http request method;
 */
$request->isPost();

/**
 * Create api for user
 */
try {
    $item = new User($db);
    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    $item->surname = $data->surname;
    $item->phone = $data->phone;
    $item->email = $data->email;
    $item->password = $data->password;

    if ($item->createUser()) {
        $response->message("Kayıt başarıyla oluşturuldu.", 200);
    } else {
        $response->message("Kayıt oluşturalamadı.", 404);
    }
} catch (Exception $exception) {
    $response->message("Bilinmeyen bir hata oluştu", 500);
}
?>