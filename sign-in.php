<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="assets/css/sign.css">
    <title>Alaaddin Adworks Challenge</title>
</head>
<body class="text-center">
<form class="form-sign" id="signin-form">
    <h1 class="h3 mb-3 font-weight-normal">Kullanıcı Girişi</h1>
    <!--response messages-->
    <div class="alert alert-success" id="response-message" role="alert"></div>
    <input type="email" name="email" id="email" class="form-control first" placeholder="E-posta" required autofocus>
    <input type="password" name="password" id="password" class="form-control" placeholder="Şifre" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş Yap</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>
<?php include "views/partials/scripts.php"; ?>
<script src="assets/js/sign-in-post.js"></script>
</body>
</html>
