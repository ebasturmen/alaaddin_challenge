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
    $item->id = !empty($data->id) ? $data->id : die();

    $item->getSingleUser();

    if ($item->name != null) {
        // create array
        $emp_arr = array(
            "id" => $item->id,
            "name" => $item->name,
            "surname" => $item->surname,
            "phone" => $item->phone,
            "email" => $item->email
        );

        $response->message("Başarılı", 200, $emp_arr);
    } else {
        $response->message("No record found.", 404);
    }
} catch (Exception $exception) {
    $response->message("Bilinmeyen Bir Hata Oluştu", 500);
}
?>