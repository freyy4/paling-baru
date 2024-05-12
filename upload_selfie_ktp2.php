<?php
session_start();
$id_daftar = $_SESSION['id_daftar'];
    if (isset($_POST['update'])) {
        $surat = basename($_FILES['uploaded_file']['name']);
        move_uploaded_file($_FILES['uploaded_file']['tmp_name'], __DIR__ . '/' . $surat);
        include "koneksi.php";
        $update = mysqli_query($koneksi, "UPDATE daftar SET selfie_ktp = '$surat' WHERE id_daftar = '$id_daftar';");
        if ($update) {
            echo "<script>
            alert('Data berhasil diperbarui 😁');
            window.location='dash2.php?id_daftar=$id_daftar';
            </script>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
?>