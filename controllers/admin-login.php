<?php
include_once '../class/Response.php';
include_once '../class/Request.php';

$request->isPost();

$username=htmlspecialchars(strip_tags($_POST['username']));
$password=htmlspecialchars(strip_tags($_POST['password']));

if (!empty($email) || !empty($password)){
    include_once '../config/database.php';

    $stmt = $db->prepare('SELECT * FROM admin WHERE username=?');
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $adminData = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($adminData) > 0){
        $pwdCheck = password_verify($password,$adminData['password']);
        if ($pwdCheck === true)
        {
            session_start();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $adminData['id'];
            $response->message("Başarıyla giriş yapıldı.", 200);
        }
        else
        {
            $response->message("Sifre hatali", 401);
        }
    }else
    {
        $response->message("Kullanıcı bulunamadı", 401);
    }


}

?>
