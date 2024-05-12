<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php
    session_start();
    include '../koneksi.php';

    // Memastikan id_daftar tersedia dan merupakan angka
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Redirect jika user tidak login
    if (empty($_SESSION['login'])) {
        header("Location:../index.php");
        exit(); // Menghentikan eksekusi script setelah redirect
    }
    ?>
    <div class="container-scroller">
        <?php include("include/sidebar.php"); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include("include/navbar.php"); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h2 class="card-title">Ubah Role</h2>
                                    </div>
                                    <div class="preview-list">
                                        <div class="card-body">
                                            <form action="ubah2.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <label for="role">Role</label>
                                                <select name="role" id="role" class="form-control">
                                                    <option value="user">User</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="admin2">Admin Daerah</option>
                                                    <option value="verifikator">Verifikator</option>
                                                </select><br>
                                                <input type="submit" value="Update" class="btn btn-primary" onClick="alet()">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/dashboard.js"></script>
</body>

</html>