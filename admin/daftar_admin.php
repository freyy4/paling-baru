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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php
    include '../koneksi.php';
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../index.php");
    }
    ?>
    <div class="container-scroller">
        <?php include("include/sidebar.php"); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include("include/navbar.php"); ?>
            <div class="main-panel">
                <?php
                    $role = $_SESSION['role'];
                    if ($role == 'admin') {
                ?>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Agency terdaftar</h2>
                                    <div class="table-responsive">
                                        <a class="btn btn-primary" href="tambah_user.php">Tambah Agency</a>
                                        <table class="table" id="mydata">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Username dan Password</th>
                                                    <th>Negara Tujuan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include '../koneksi.php';
                                                $sql1 = "SELECT * FROM agensi";
                                                $result = mysqli_query($koneksi, $sql1);
                                                $no = 1;
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $password = $row["password"];
                                                        $firstTwoChars = substr($password, 0, 3);
                                                        $maskedPassword = $firstTwoChars . str_repeat('*', strlen($password) - 2);
                                                        echo "<tr>";
                                                        echo "<td>" . $no++ . "</td>";
                                                        echo "<td>" . $row["username"] . '<br>' . $maskedPassword . " <a href='javascript:void(0)' class='btn btn-primary' id='btn' onclick='copyText(\"" . $row["password"] . "\")'>Copy</a></td>";
                                                        echo "<td>" . $row["negara"] . "</td>";
                                                        echo "<td>
                                    <a href='edit_agensi.php?id=" . $row['id'] . "' class='btn btn-primary'>Ubah</a><br>
                                    <a href='hapus_agensi.php?id=" . $row['id'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\" class='btn btn-danger'>Hapus</a>
                                    </td>";
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
                </div>
                <?php
                    }
                ?>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">User terdaftar</h2>
                                    <div class="table-responsive">
                                        <table class="table" id="mydata2">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Nomor Whatsapp</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include '../koneksi.php';
                                                $sql1 = "SELECT * FROM login WHERE role='user' AND id_daftar IS NOT NULL ORDER BY id DESC";
                                                $result = mysqli_query($koneksi, $sql1);
                                                $no = 1;
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $no++ . "</td>";
                                                        echo "<td>" . $row["nama"] . "</td>";
                                                        echo "<td>" . $row["nowa"] . "</td>";
                                                        if ($role !== 'admin') {
                                                            echo "<td>
                                                                    <a href='https://wa.me/+62" . $row['nowa'] . "' class='btn btn-success' target='_blank'>
                                                                        <i class='bi bi-whatsapp'></i>
                                                                    </a>
                                                                    <a href='tel:+62" . $row['nowa'] . "' class='btn btn-danger' target='_blank'>
                                                                        <i class='bi bi-telephone-fill'></i>
                                                                    </a>
                                                                  </td>";
                                                        } else {
                                                            echo "<td>
                                                                    <a href='ubah.php?id=" . $row['id'] . "' class='btn btn-primary'>Ubah Role</a>
                                                                  </td>";
                                                        }
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
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">User belum terdaftar</h2>
                                    <div class="table-responsive">
                                        <table class="table" id="mydata3">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Nomor Whatsapp</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include '../koneksi.php';
                                                $sql1 = "SELECT * FROM login WHERE role='user' AND id_daftar IS NULL ORDER BY id DESC";
                                                $result = mysqli_query($koneksi, $sql1);
                                                $no = 1;
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $no++ . "</td>";
                                                        echo "<td>" . $row["nama"] . "</td>";
                                                        echo "<td>" . $row["nowa"] . "</td>";
                                                        echo "<td>
                                    <a href='https://wa.me/+62" . $row['nowa'] . "' class='btn btn-success' target='blank'>
                                        <i class='bi bi-whatsapp'></i>
                                    </a>
                                    <a href='tel:+62" . $row['nowa'] . "' class='btn btn-danger' target='blank'>
                                        <i class='bi bi-telephone-fill'></i>
                                    </a>
                                    </td>";
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
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Tim Verifikasi</h2>
                                    <div class="table-responsive">
                                        <table class="table" id="mydata3">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Nomor Whatsapp</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include '../koneksi.php';
                                                $sql1 = "SELECT * FROM login WHERE role='verifikator' ORDER BY id DESC";
                                                $result = mysqli_query($koneksi, $sql1);
                                                $no = 1;
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $no++ . "</td>";
                                                        echo "<td>" . $row["nama"] . "</td>";
                                                        echo "<td>" . $row["nowa"] . "</td>";
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
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Tim Admin</h2>
                                    <div class="table-responsive">
                                        <table class="table" id="mydata3">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Nomor Whatsapp</th>
                                                    <th>Hubungi Admin</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include '../koneksi.php';
                                                $sql1 = "SELECT * FROM login WHERE role='admin' ORDER BY id DESC";
                                                $result = mysqli_query($koneksi, $sql1);
                                                $no = 1;
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $no++ . "</td>";
                                                        echo "<td>" . $row["nama"] . "</td>";
                                                        echo "<td>" . $row["nowa"] . "</td>";
                                                        echo "<td>
                                    <a href='https://wa.me/+62" . $row['nowa'] . "' class='btn btn-success' target='blank'>
                                        <i class='bi bi-whatsapp'></i>
                                    </a>
                                    <a href='tel:+62" . $row['nowa'] . "' class='btn btn-danger' target='blank'>
                                        <i class='bi bi-telephone-fill'></i>
                                    </a>
                                    </td>";
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
                </div>
                <?php include("include/footer.php"); ?>
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
    <script>
        $(document).ready(function() {
            $('#mydata').DataTable({
                "paging": false,
                "info": true,
            });
        });
        $(document).ready(function() {
            $('#mydata2').DataTable({
                "paging": false,
                "info": true,
            });
        });
        $(document).ready(function() {
            $('#mydata3').DataTable({
                "paging": false,
                "info": true,
            });
        });
        function copyText(password) {
            var tempTextArea = document.createElement("textarea");
            tempTextArea.value = password;
            document.body.appendChild(tempTextArea);
            tempTextArea.select();
            tempTextArea.setSelectionRange(0, 99999);
            document.execCommand("copy");
            document.body.removeChild(tempTextArea);
            var btn = document.getElementById("btn");
            btn.innerHTML = "Copied";
            setTimeout(function() {
                copyButton.innerHTML = "Copy";
            }, 10000);
        }
    </script>
</body>

</html>