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

        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $e = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "surname" => $row['surname'],
                "phone" => $row['phone'],
                "email" => $row['email'],
            );

            array_push($employeeArr["body"], $e);
        }

        $response->message("Başarılı", 200, $employeeArr);
    } else {
        $response->message("No record found.", 404);
    }

} catch (Exception $exception) {
    $response->message("Bilinmeyen Bir Hata Oluştu", 500);
}