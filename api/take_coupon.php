<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/coupons.php';
include_once '../class/Response.php';
include_once '../class/Request.php';

$request->isPut();

try {
    $item = new Coupons($db);
    $data = json_decode(file_get_contents("php://input"));

    $item->user_id = $data->user_id;
    $item->coupon_id = $data->coupon_id;

    if ($item->takeCode()) {
        $response->message("Kupon alımı başarıyla gerçekleşti.", 200);
    } else {
        $response->message("Sadece bir kez kupon alabilirsiniz.", 404);
    }
} catch (Exception $exception) {
    $response->message("Bilinmeyen bir hata oluştu", 500);
}
?>