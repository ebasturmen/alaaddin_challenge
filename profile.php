<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: http://localhost/sign-in.php");
    exit();
} else {
    include_once 'config/database.php';
    include_once 'class/users.php';
    include_once 'class/coupons.php';
    $user = new User($db);
    $user->id = $_SESSION['id'];
    $user->getSingleUser();

    $coupon = new Coupons($db);
    $coupon->owner_id = $_SESSION['id'];
    $coupon->get_coupon();
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include "views/partials/head.php"; ?>
    <title>Profil - Alaaddin Adworks Challenge</title>
</head>
<body>
<div class="container">
    <?php include "views/partials/jumbotron.php"; ?>
    <?php include "views/partials/navbar.php"; ?>
    <div class="col-12 profile p-0">
        <div class="profile-box">
            <div class="row no-gutters justify-content-between">
                <div class="col-md-2 profile-image">
                    <img src="assets/images/default-photo.jpg" alt="Logo">
                </div>
                <div class="col-md-7 profile-title">
                    <h3>Hesap Bilgilerim</h3>
                    <ul>
                        <li><?php echo $user->name ?></li>
                        <li><?php echo $user->surname ?></li>
                        <li><?php echo $user->phone ?></li>
                        <li><?php echo $user->email ?></li>
                    </ul>
                </div>
                <div class="col-md-2 discount-code-button">
                    <a class="btn btn-primary btn-lg btn-block" href="/profile-edit.php" role="button">Profili
                        Düzenle</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 coupon-box">
        <h3>Kupon Bilgilerim</h3>
        <ul>
            <?php if (!is_null($coupon->code)) { ?>
                <li><?php echo $coupon->code ?></li>
            <?php } else { ?>
                <li>Henüz kupon kodu almadınız.</li>
            <?php } ?>
        </ul>
    </div>
</div>
<?php include "views/partials/scripts.php"; ?>
</body>
</html>