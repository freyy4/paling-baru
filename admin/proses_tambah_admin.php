<?php
include('../koneksi.php');

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $negara = $_POST['negara'];
    
    // Hash password sebelum menyimpannya ke database
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Simpan data ke database
    $result = mysqli_query($koneksi, "INSERT INTO agensi (username, password, negara) VALUES ('$username', '$password', '$negara')");
    
    if ($result) {
        ?>
        <script>
            alert("Pendaftaran Berhasil");
            window.location.replace('daftar_admin.php');
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Registrasi Gagal, Coba lagi");
            window.location.replace('tambah_user.php');
        </script>
        <?php
    }
}
?>
