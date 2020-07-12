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
$request->isDelete();

/**
 * Delete api for user
 */
try {
    $item = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->id = $data->id;

    if ($item->deleteUser()) {
        $response->message("Kayıt başarıyla silindi.", 200);
    } else {
        $response->message("Kayıt silme başarısız oldu.", 404);
    }
} catch (Exception $exception) {
    $response->message("Bilinmeyen bir hata oluştu", 500);
}
?>