<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Anasayfa <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kullanıcı
                </a>
                <?php if(isset($_SESSION['logged_in'])) { ?>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/profile.php">Hesabım</a>
                        <a class="dropdown-item" href="/controllers/logout.php">Kullanıcı Çıkış</a>
                    </div>
                <?php } else { ?>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/sign-in.php">Kullanıcı Giriş</a>
                        <a class="dropdown-item" href="/sign-up.php">Kullanıcı Kayıt</a>
                    </div>
                <?php } ?>

            </li>
        </ul>
    </div>
</nav>