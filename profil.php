<?php include "head.php"; ?>

<?php
      $id_daftar = $_SESSION['id_daftar'];
  ?>
<?php
  session_start();
  if (empty($_SESSION['login'])) {
      header("Location:index.php");
  }
  include "koneksi.php";
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include "navbar.php"; ?>
        <?php include "sidebar.php"; ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>
                                <?php
                                    $nama = $_SESSION['nama'] ?? $_SESSION['nowa'];
                                    echo htmlspecialchars($nama);
                                    ?>
                            </h2>
                            <p>Email :
                                <?php
                                    $email = $_SESSION['email'];
                                    if ($email) {
                                        echo $email;
                                    } else {
                                        echo "-";
                                    }
                                ?>
                            </p>

                            <p>Nomor WhatsApp :
                                <?php
                                    $nowa = $_SESSION['nowa'];
                                    echo $nowa ? htmlspecialchars($nowa) : "-";
                                ?>
                            </p>

                            <div class="social-links">
                                <a href="edit_profil.php" class="btn btn-success">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        </section>
    </div>
</body>
<?php include "foot.php"; ?>

</html>