<?php
    session_start();

include_once 'config/database.php';
include_once 'class/coupons.php';
$coupons = new Coupons($db);
$coupons_array = $coupons->getCodes();
$couponsCount = $coupons_array->rowCount();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include "views/partials/head.php";?>
    <title>Alaaddin Adworks Challenge</title>
</head>
<body>
<div class="container">
    <?php include "views/partials/jumbotron.php";?>
    <?php include "views/partials/navbar.php";?>
    <div class="col-12 discount-code-list p-0">
        <?php foreach($coupons_array as $coupon) { ?>
        <div class="discount-code-box">
            <div class="row no-gutters justify-content-between">
                <div class="col-md-2 discount-code-company">
                    <img src="assets/images/logo/logo.png" alt="Logo">
                </div>
                <div class="col-md-6 discount-code-title">
                    <h4><?php echo $coupon['title']?></h4>
                </div>
                <div class="col-md-2 discount-code-button">
                    <?php if(isset($_SESSION['logged_in'])) { ?>
                        <form id="take-coupon-form">
                            <input type="hidden" name="id" id="id" value="<?php echo $coupon['id']?>">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Kodu Alın</button>
                        </form>
                    <?php } else { ?>
                        <a class="btn btn-primary btn-lg btn-block" href="/sign-in.php" role="button">Kodu Alın</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php include "views/partials/scripts.php";?>
</body>
</html>