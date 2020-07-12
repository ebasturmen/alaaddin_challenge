<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    //if admin not logged_in redirect to sign-in
    header("Location: http://localhost/admin/sign-in.php");
    exit();
} else {
    include_once '../config/database.php';
    include_once '../class/users.php';
    $all_users = new User($db);
    //get all users
    $users_array = $all_users->getUsers();
    //if needed
    $usersCount = $users_array->rowCount();
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include "../views/partials/head.php"; ?>
    <title>Dashboard - Alaaddin Adworks Challenge</title>
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
        <!--response messages-->
        <div class="alert alert-success" id="response-message" role="alert"></div>
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
            <?php foreach ($users_array as $user) { ?>
                <tr>
                    <th scope="row"><?php echo $user['id'] ?></th>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['surname'] ?></td>
                    <td><?php echo $user['phone'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td>
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user['id'] ?>">
                        <button class="btn btn-sm btn-warning delete-button" type="button" data-toggle="modal"
                                data-target="#delete-modal"><span style="font-size: 16px"
                                                                  class="material-icons">delete</span></button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-modalLongTitle">Kullanıcı Sil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--   response messages-->
                <div style="text-align: center" class="alert alert-success" id="response-message" role="alert"></div>
                <p>Kullanıcıyı silmek istediğinize emin misiniz?</p>
            </div>
            <div class="modal-footer">
                <form id="delete-user-form">
                    <input type="hidden" name="id" id="id" value="">
                    <button type="submit" class="btn btn-primary">Evet</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
            </div>
        </div>
    </div>
</div>
<?php include "../views/partials/scripts.php"; ?>
<script src="../assets/js/admin-delete.js"></script>
<script>
    /*  construct modal*/
    $('.delete-button').on('click', function () {
        var id = $(this).closest('td').find("#user_id").val();
        $("#id").val(id);
    });
</script>
</body>
</html>