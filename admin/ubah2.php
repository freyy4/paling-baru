<?php
if (isset($_POST['id'], $_POST['role'])) {
    include '../koneksi.php';
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $role = mysqli_real_escape_string($koneksi, $_POST['role']);
    $update = "UPDATE login SET role='$role' WHERE id='$id'";
    if (mysqli_query($koneksi, $update)) {
        echo "<script>window.location.href = 'daftar_admin2.php';</script>";
    } else {
        echo "Terjadi kesalahan dalam memperbarui data: " . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
}
