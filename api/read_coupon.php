<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../class/coupons.php';
include_once '../class/Response.php';
include_once '../class/Request.php';

/**
 * Check http request method;
 */
$request->isPost();

/**
 * read single coupon api function
 */
try {
    $items = new Coupons($db);
    $stmt = $items->getCodes();
    $itemCount = $stmt->rowCount();
    if ($itemCount > 0) {
        $couponArr = array();
        $couponArr["body"] = array();
        $couponArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $e = array(
                "id" => $row['id'],
                "code" => $row['code']
            );
            array_push($couponArr["body"], $e);
        }
        $response->message("Kayıt bulundu.", 200, $couponArr);
    } else {
        $response->message("Kayıt bulunamadı.", 404);
    }
} catch (Exception $exception) {
    $response->message("Bilinmeyen bir hata oluştu", 500);
}