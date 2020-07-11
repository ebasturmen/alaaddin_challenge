<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../class/users.php';
include_once '../class/Response.php';
include_once '../class/Request.php';

$request->isPost();

try {

    $items = new User($db);

    $stmt = $items->getUsers();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {

        $userArr = array();
        $userArr["body"] = array();
        $userArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $e = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "surname" => $row['surname'],
                "phone" => $row['phone'],
                "email" => $row['email'],
            );

            array_push($userArr["body"], $e);
        }

        $response->message("Kayıt bulundu.", 200, $userArr);
    } else {
        $response->message("Kayıt bulunamadı.", 404);
    }

} catch (Exception $exception) {
    $response->message("Bilinmeyen bir hata oluştu", 500);
}