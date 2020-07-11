<?php
session_start();
if(!isset($_SESSION['admin_logged_in']))
{
    header("Location: http://localhost/admin/sign-in.php");
    exit();
}
else
{
    include_once '../config/database.php';
    include_once '../class/users.php';
    $all_users = new User($db);
    $users_array = $all_users->getUsers();
    $usersCount = $users_array->rowCount();
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include "../views/partials/head.php";?>
    <title>Alaaddin Adworks Challenge</title>
</head>
<body>
<div class="container">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/admin/dashboard.php">Anasayfa <span class="sr-only">(current)</span></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Yönetici
                    </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/controllers/logout.php">Yönetici Çıkış</a>
                        </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="col-12 user-list p-0 mt-4">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ad</th>
                <th scope="col">Soyad</th>
                <th scope="col">Telefon</th>
                <th scope="col">E-posta</th>
                <th scope="col">İşlemler</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($users_array as $user) { ?>
            <tr>
                <th scope="row"><?php echo $user['id']?></th>
                <td><?php echo $user['name']?></td>
                <td><?php echo $user['surname']?></td>
                <td><?php echo $user['phone']?></td>
                <td><?php echo $user['email']?></td>
                <td><span class="material-icons">delete</span></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "../views/partials/scripts.php";?>
</body>
</html>