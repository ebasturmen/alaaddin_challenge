<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="assets/css/sign.css">
    <title>Yeni Kayıt - Alaaddin Adworks Challenge</title>
</head>
<body class="text-center">
<form class="form-sign" id="register-form">
    <h1 class="h3 mb-3 font-weight-normal">Kullanıcı Kayıt</h1>
    <div class="alert alert-success" id="response-message" role="alert">

    </div>
    <input type="text" name="name" id="name" class="form-control first" placeholder="Ad" required autofocus>
    <input type="text" name="surname" id="surname" class="form-control" placeholder="Soyad" required>
    <input type="text" name="phone" id="phone" class="form-control" placeholder="Telefon" required>
    <input type="email" name="email" id="email" class="form-control" placeholder="E-posta" required >
    <input type="password" name="password" id="password" class="form-control" placeholder="Şifre" required>


    <button class="btn btn-lg btn-primary btn-block" type="submit">Kaydol</button>
    <a class="btn btn-lg btn-primary btn-block" href="/" role="button">Anasayfa'ya dön</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>

<?php include "views/partials/scripts.php";?>
<script src="assets/js/register-post.js"></script>
</body>
</html>
