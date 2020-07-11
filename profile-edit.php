<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
    header("Location: http://localhost/sign-in.php");
    exit();
}
else
{
    include_once 'config/database.php';
    include_once 'class/users.php';
    $user = new User($db);
    $user->id = $_SESSION['id'];
    $user->getSingleUser();
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include "views/partials/head.php";?>
    <title>Profil - Alaaddin Adworks Challenge</title>
</head>
<body>
<div class="container">
    <?php include "views/partials/jumbotron.php";?>
    <?php include "views/partials/navbar.php";?>
    <div class="col-12 profile-edit p-0 mt-4">
        <div class="alert alert-success" id="response-message" role="alert">

        </div>
        <form id="update-user-form">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="name">Ad</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $user->name ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="surname">Soyad</label>
                    <input type="text" class="form-control" name="surname" id="surname" value="<?php echo $user->surname ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="phone">Telefon</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $user->phone ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="text" class="form-control" value="<?php echo $user->email ?>" disabled>
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="<?php echo $user->id ?>">
            <button class="btn btn-primary" type="submit">Değişiklikleri Kaydet</button>
        </form>
    </div>
</div>
<?php include "views/partials/scripts.php";?>
<script src="assets/js/update-user-post.js"></script>
</body>
</html>