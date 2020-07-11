<?php
include_once '../class/Response.php';
include_once '../class/Request.php';

$request->isPost();

$email=htmlspecialchars(strip_tags($_POST['email']));
$password=htmlspecialchars(strip_tags($_POST['password']));

if (!empty($email) || !empty($password)){
    include_once '../config/database.php';

    $stmt = $db->prepare('SELECT * FROM users WHERE email=?');
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $pwdCheck = password_verify($password,$userData['password']);
    if ($pwdCheck === true)
    {
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $userData['id'];
        $_SESSION['name'] = $userData['name'];
        $_SESSION['email'] = $userData['email'];
        $response->message("Başarılı", 200);
    }
    else
    {
        $response->message("Şifre hatalı", 401);
        exit();
    }
}

?>
