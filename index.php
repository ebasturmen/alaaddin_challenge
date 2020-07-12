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
                        <input type="hidden" name="index_id" id="index_id" value="<?php echo $coupon['id']?>">
                        <input type="hidden" name="index_title" id="index_title" value="<?php echo $coupon['title']?>">
                        <button type="button" class="btn btn-primary btn-lg btn-block coupon-button" data-toggle="modal" data-target="#take-coupon-modal">Kodu Alın</button>
                    <?php } else { ?>
                        <a class="btn btn-primary btn-lg btn-block" href="/sign-in.php" role="button">Kodu Alın</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php if(isset($_SESSION['logged_in'])) { ?>
<!-- Modal -->
<div class="modal fade" id="take-coupon-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="take-coupon-modalLongTitle">Kupon Al</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="text-align: center" class="alert alert-success" id="response-message" role="alert">

                </div>
                <h4 style="text-align: center" id="title"></h4>
                <form id="take-coupon-form">
                    <input type="hidden" name="coupon_id" id="coupon_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id'] ?>">
                    <button type="submit" class="btn btn-warning btn-lg btn-block mt-5 mb-2">İndirim kuponunu alın</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include "views/partials/scripts.php";?>
<script src="assets/js/take-coupon-post.js"></script>
<script>
    $('.coupon-button').on('click', function () {
        var id = $(this).closest('.discount-code-button').find("#index_id").val();
        var title = $(this).closest('.discount-code-button').find("#index_title").val();

        $("#coupon_id").val(id);
        $("#title").text(title);
    });
</script>
</body>
</html>