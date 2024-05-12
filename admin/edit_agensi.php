<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Edit Data Agensi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <?php
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../index.php");
        exit; // Menghentikan eksekusi lebih lanjut jika tidak ada sesi login.
    }

    // Sertakan file koneksi ke database
    include '../koneksi.php';

    // Inisialisasi variabel
    $id = $_GET['id'];

    // Periksa apakah parameter 'id' telah diterima melalui URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query SQL untuk mengambil data agensi berdasarkan ID
        $sql = "SELECT * FROM agensi WHERE id = $id";
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $namaAgensi = $row['username'];
            $passwordAgensi = $row['password'];
            $negaraTujuan = $row['negara_tujuan'];
        } else {
            die("Data tidak ditemukan."); // Menghentikan eksekusi jika data tidak ditemukan.
        }
    }

    // Proses pembaruan data agensi jika form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $namaAgensiBaru = $_POST['username'];
        $passwordAgensiBaru = $_POST['password'];
        $negaraTujuanBaru = $_POST['negara'];

        // Query SQL untuk mengupdate data agensi
        $updateSql = "UPDATE agensi SET username='$namaAgensiBaru', password='$passwordAgensiBaru', negara='$negaraTujuanBaru' WHERE id=$id";

        if (mysqli_query($koneksi, $updateSql)) {
            echo "<script>alert('Data agensi berhasil diperbarui.');</script>";
            echo "<script>window.location.replace('daftar_admin.php');</script>";
        } else {
            echo "Error: " . $updateSql . "<br>" . mysqli_error($koneksi);
        }
    }
    ?>

    <div class="container">
        <h3>Edit Data Agensi</h3>
        <form method="post" action="edit_agensi.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="username">Nama Agensi:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $namaAgensi; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $passwordAgensi; ?>" required>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="showPassword">
                    <label class="form-check-label" for="showPassword">Tampilkan password</label>
                </div>
            </div>

            <div class="form-group">
                <label for="nama_lengkap">Negara Tujuan *</label>
                <select id="status" name="negara" class="form-control" required>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Singapura">Singapura</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Korea Selatan">Korea Selatan</option>
                    <option value="Jepang">Jepang</option>
                </select>
            </div>

            <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById("password");
        const showPasswordCheckbox = document.getElementById("showPassword");

        showPasswordCheckbox.addEventListener("change", function() {
            if (this.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    </script>

</body>

</html>