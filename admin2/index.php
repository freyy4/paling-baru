<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Admin Daerah PT Crystal Biru Meuligo</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
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
    if ($_SESSION['role'] !== 'admin2') {
        echo "<script>alert('Akses ditolak. Hanya admin yang diizinkan mengakses halaman ini.')
        </script>";
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
                                <h3 class="card-title">Daftar PMI yang sudah Masuk</h3>
                                <a class="btn btn-primary" href="../daftaraa.php">Tambah Data PMI</a>
                                <div class="table-responsive">
                                    <table class="table" id="mydata">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Lengkap</th>
                                                <th>Penerimaan</th>
                                                <th>Aktif</th>
                                                <th><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                                    </svg></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include '../koneksi.php';
                                            $sql1 = "SELECT * FROM `daftar` WHERE sponsor = '{$_SESSION['nama']}' ORDER BY `id` DESC;";
                                            $result = mysqli_query($koneksi, $sql1);
                                            $_SESSION['id_daftar'] = $id_daftar;
                                            $no = 1;
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $no++ . "</td>";
                                                    echo "<td>" . $row["nama_lengkap"] . "</td>";
                                                    echo "<td class='" . ($row["terima"] === "terima" ? "text-success" : "text-danger") . "'>" . $row["terima"] . "</td>";
                                                    echo "<td class='" . ($row["aktif"] === "aktif" ? "text-success" : "text-danger") . "'>" . $row["aktif"] . "</td>";
                                                    echo "<td><a href='../dash3.php?id_daftar=" . $row["id_daftar"] . "' class='btn btn-primary'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-down-right-circle-fill' viewBox='0 0 16 16'>
                                                        <path d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm5.904-2.803a.5.5 0 1 0-.707.707L9.293 10H6.525a.5.5 0 0 0 0 1H10.5a.5.5 0 0 0 .5-.5V6.525a.5.5 0 0 0-1 0v2.768L5.904 5.197z'/>
                                                    </svg>
                                                    Lihat</a></td>";
                                                    echo "</tr>";
                                                }
                                            }

                                            $koneksi->close();
                                            ?>
                                        </tbody>
                                    </table>
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