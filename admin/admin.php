<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Admin PT Crystal Biru Meuligo</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="favicon.jpg" />
</head>

<body>
    <?php
    include '../koneksi.php';
    //Buat Sesi
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../index.php");
    }
    ?>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <?php include("include/sidebar.php"); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <?php include("include/navbar.php"); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Daftar Calon Pekerja Migran Indonesia.</h3>
                                <a class="btn btn-primary" href="../daftara.php">Tambah Data PMI</a>
                                <div class="row">
                                </div>
                            </div>
                        </div>
                        <?php
                            include '../koneksi.php';
                            $sql1 = "SELECT * FROM `daftar` ORDER BY `id` DESC;";
                            $result = mysqli_query($koneksi, $sql1);
                            $no = 1;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="../<?php echo $row["pas"]; ?>" class="card-img-top" alt="Pas Foto">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row["nama_lengkap"]; ?></h5>
                                        <p class="card-text">
                                            <span class="badge <?php echo ($row["terima"] === "terima" ? "badge-success" : "badge-danger"); ?>"><?php echo $row["terima"]; ?></span>
                                            <span class="badge <?php echo ($row["aktif"] === "aktif" ? "badge-success" : "badge-danger"); ?>"><?php echo $row["aktif"]; ?></span>
                                            <span class="badge badge-success"><?php echo $row["sponsor"]; ?></span>
                                        </p>
                                        <a href="../dash2.php?id_daftar=<?php echo $row["id_daftar"]; ?>"
                                            class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-arrow-down-right-circle-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm5.904-2.803a.5.5 0 1 0-.707.707L9.293 10H6.525a.5.5 0 0 0 0 1H10.5a.5.5 0 0 0 .5-.5V6.525a.5.5 0 0 0-1 0v2.768L5.904 5.197z" />
                                            </svg>
                                            Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                                    }
                                                }
                                                $koneksi->close();
                                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <?php include("include/footer.php"); ?>
    <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
    <script>
    $(document).ready(function() {
        $('#mydata').DataTable({
            "paging": false,
            "info": false,
        });
    });
    </script>
</body>

</html>