<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Admin PT Crystal Biru Meuligo</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <?php
    include '../koneksi.php';
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../index.php");
    }
    if ($_SESSION['role'] === 'user' ) {
        echo "<script>alert('Akses ditolak. Hanya admin dan verifikator yang diizinkan mengakses halaman ini.')
        </script>";
        header("Location:../index.php");
    }
    function greetings()
    {
        date_default_timezone_set('Asia/Jakarta'); // Ganti dengan zona waktu yang sesuai

        $currentHour = date('G');

        if ($currentHour >= 5 && $currentHour < 12) {
            return "Selamat Pagi!";
        } elseif ($currentHour >= 12 && $currentHour < 15) {
            return "Selamat Siang!";
        } elseif ($currentHour >= 15 && $currentHour < 18) {
            return "Selamat Siang!";
        } else {
            return "Selamat Malam!";
        }
    }
    $sapaan = greetings();
    // Jumlah Agensi
    $agensi = "SELECT * FROM agensi";
    $result_agensi = mysqli_query($koneksi, $agensi);
    $jumlahagensi = mysqli_num_rows($result_agensi);
    // Jumlah Pengaduan
    $pengaduan = "SELECT * FROM pengaduan";
    $result_pengaduan = mysqli_query($koneksi, $pengaduan);
    $jumlahpengaduan = mysqli_num_rows($result_pengaduan);
    // Jumlah Admin
    $admin = "SELECT * FROM login WHERE role='user';";
    $result_admin = mysqli_query($koneksi, $admin);
    $jumlahadmin = mysqli_num_rows($result_admin);
    // Jumlah Sponsor
    $admin2 = "SELECT * FROM login WHERE role='admin2';";
    $result_admin2 = mysqli_query($koneksi, $admin2);
    $jumlahadmin2 = mysqli_num_rows($result_admin2);
    // Jumlah User Terverifikasi
    $userverify = "SELECT * FROM login WHERE status=1";
    $result_userverify = mysqli_query($koneksi, $userverify);
    $jumlahterverfikasi = mysqli_num_rows($result_userverify);
    // Jumlah diterima
    $terima = "SELECT * FROM daftar WHERE terima='terima' AND aktif='aktif'";
    $result_terima = mysqli_query($koneksi, $terima);
    $jumlahditerima = mysqli_num_rows($result_terima);
    // Jumlah ditolak
    $tolak = "SELECT * FROM daftar WHERE terima='tolak' AND aktif='nonaktif'";
    $result_tolak = mysqli_query($koneksi, $tolak);
    $jumlahtolak = mysqli_num_rows($result_tolak);
    //Total keseluruhan
    $total = "SELECT * FROM daftar";
    $result_total = mysqli_query($koneksi, $total);
    $jumlahtotal = mysqli_num_rows($result_total);
    //Pengaduan
    $aduan = "SELECT * FROM pengaduan";
    $result_aduan = mysqli_query($koneksi, $aduan);
    $jumlahaduan = mysqli_num_rows($result_aduan);
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
                    <h2><?php echo $sapaan; ?>, <?php echo $_SESSION['role'] ?></h2><br>
                    <div class="row">
                        <div class="col-xl-9 col-sm-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <img src="../polotno.png" class="img-fluid" style="height: 400px; width:800px; border-radius: 5px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0"><?php echo $jumlahagensi ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Jumlah Agency</h6>
                                    <a href="daftar_admin.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0"><?php echo $jumlahadmin ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Jumlah User</h6>
                                    <a href="daftar_admin.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0"><?php echo $jumlahadmin2 ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Jumlah Sponsor</h6>
                                    <a href="daftar_admin.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0 text-success"><?php echo $jumlahditerima ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Jumlah PMI yang diterima</h6>
                                    <a href="admin.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0 text-danger"><?php echo $jumlahtolak ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Jumlah PMI yang ditolak dan nonaktif</h6>
                                    <a href="admin.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0 text-primary"><?php echo $jumlahtotal ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Total PMI yang sudah mendaftar</h6>
                                    <a href="admin.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0"><?php echo $jumlahaduan ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Jumlah Pengaduan yang masuk</h6>
                                    <a href="daftar_pengaduan.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2>Grafik Data Masuk PMI</h2><br>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="myChart3" width="1000" height="400"></canvas>
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
    <script>
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                var labels = Object.keys(data);
                var values = Object.values(data);
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Grafik Perhari',
                            data: data,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                min: 0, // Nilai minimum sumbu Y
                                max: 100 // Nilai maksimum sumbu Y
                            }
                        }
                    }
                });
            }
        };
        xhttp.open("GET", "get_data.php", true);
        xhttp.send();
    </script>
    <script>
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                var labels = Object.keys(data);
                var values = Object.values(data);
                var ctx = document.getElementById('myChart2').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Grafik Per Minggu',
                            data: data,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                min: 0, // Nilai minimum sumbu Y
                                max: 100 // Nilai maksimum sumbu Y
                            }
                        }
                    }
                });
            }
        };
        xhttp.open("GET", "get_data2.php", true);
        xhttp.send();
    </script>
    <script>
        var ctx = document.getElementById('myChart3').getContext('2d');
        fetch('get_data3.php')
            .then(response => response.json())
            .then(data => {
                var bulan = [];
                var jumlah_data = [];

                data.forEach(item => {
                    bulan.push(item.bulan);
                    jumlah_data.push(item.jumlah_data);
                });

                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: bulan,
                        datasets: [{
                            label: 'Jumlah Data per Bulan',
                            data: jumlah_data,
                            borderColor: 'rgba(0, 255, 0, 1)', // Warna hijau tanpa transparansi
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                min: 0, // Nilai minimum sumbu Y
                                max: 100 // Nilai maksimum sumbu Y
                            }
                        }
                    }
                });
            });
    </script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
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
</body>

</html>