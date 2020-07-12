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
$request->isPut();

/**
 * Update user's infos
 */
try {

    $item = new User($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->id = $data->id;

    $item->name = $data->name;
    $item->surname = $data->surname;
    $item->phone = $data->phone;

    if ($item->updateUser()) {
        $response->message("Kayıt başarıyla güncellendi.", 200);
    } else {
        $response->message("Kayıt güncelleme başarısız oldu.", 404);
    }
} catch (Exception $exception) {
    $response->message("Bilinmeyen bir hata oluştu", 500);
}
?>