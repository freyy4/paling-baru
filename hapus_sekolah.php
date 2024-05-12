<?php
session_start();
include "koneksi.php";

if (isset($_GET['id'])) {
    $id_sekolah = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Hapus data dari database
    $query = "DELETE FROM sekolah WHERE id = '$id_sekolah'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
            window.location.href = 'dash.php';
        </script>";
    } else {
        echo "<script>
            window.location.href = 'dash.php';
        </script>";
    }
} else {
    echo "<script>
        window.location.href = 'dash.php';
    </script>";
}
?>
