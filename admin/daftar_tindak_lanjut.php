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
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php
    $id_pengaduan = $_GET['id_pengaduan'];
    include 'koneksi.php';
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
                    <div class="row">
                        <div class="col-md-6 col-xl-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h2 class="card-title">Detail Data Pengaduan</h4>
                                    </div>
                                    <div class="preview-list">
                                        <div class="card-body">
                                            <?php
                                            include '../koneksi.php';
                                            $sql1 = "SELECT * FROM pengaduan WHERE id_pengaduan = $id_pengaduan";
                                            $result = mysqli_query($koneksi, $sql1);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <style>
                                                        label {
                                                            font-weight: bolder;
                                                        }
                                                    </style>
                                                    <label for="">Nomor Induk Kependudukan</label>
                                                    <p><?php echo $row["nik"]; ?></p>
                                                    <label for="">Nama Lengkap</label>
                                                    <p><?php echo $row["nama_lengkap"]; ?></p>
                                                    <label for="">Email</label>
                                                    <p><?php echo $row["email"]; ?></p>
                                                    <label for="">Nomor Handphone</label>
                                                    <p><?php echo $row["nomor_hp"]; ?></p>
                                                    <label for="">Hubungan dengan PMI</label>
                                                    <p><?php echo $row["hubungan_pm"]; ?></p>
                                                    <label for="">Permasalahan</label>
                                                    <p><?php echo $row["permasalahan"]; ?></p>
                                                    <label for="">Nomor Induk Kependudukan PMI</label>
                                                    <p><?php echo $row["nik_pmi"]; ?></p>
                                                    <label for="">Nama PMI</label>
                                                    <p><?php echo $row["nama_pmi"]; ?></p>
                                                    <label for="">Alamat PMI</label>
                                                    <p><?php echo $row["alamat_pmi"]; ?></p>
                                                    <label for="">Tanggal Terbang</label>
                                                    <p><?php echo $row["tgl_terbang"]; ?></p>
                                                    <label for="">Negara Tujuan PMI</label>
                                                    <p><?php echo $row["negara_tujuan"]; ?></p>
                                                    <label for="">Status PMI</label>
                                                    <p><?php echo $row["selesai"]; ?></p>
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
                        <div class="col-md-6 col-xl-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Data Tindak Lanjut</h2>
                                    <a href="tindak_lanjut.php?id_pengaduan=<?php echo $id_pengaduan ?>" class="btn btn-primary">&plus; Tambah Tindak Lanjut</a>
                                    <div class="d-flex py-4">
                                        <div class="preview-list w-100">
                                            <div class="preview-item p-0">
                                                <div class="preview-item-content d-flex flex-grow table-responsive">
                                                    <table class="table" id="mydata">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Catatan</th>
                                                                <th>Dokumen</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            include '../koneksi.php';
                                                            $sql1 = "SELECT * FROM tindak_lanjut WHERE id_pengaduan = $id_pengaduan";
                                                            $result = mysqli_query($koneksi, $sql1);
                                                            $no = 1;
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $no++; ?></td>
                                                                        <td><?php echo $row["catatan"]; ?></td>
                                                                        <td>
                                                                            <a href="https://daftarpmi.karyatenagamandiri.co.id/admin/<?php echo $row['dokumen']; ?>" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                                                </svg> Download File</a>
                                                                        </td>
                                                                    </tr>

                                                            <?php
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
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
                "language": {
                    "infoEmpty": 'Tidak ada Data',
                    "zeroRecords": 'Belum ada tindakan apapun',
                    "lengthMenu": 'Lihat _MENU_ rekaman per halaman',
                    "search": 'Cari',
                }
            });
        });
    </script>
</body>

</html>