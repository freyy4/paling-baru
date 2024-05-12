<?php
// Sertakan file koneksi database
include '../koneksi.php';

// Periksa apakah parameter 'id' telah diterima melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query SQL untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM tindak_lanjut WHERE id = $id";

    if (mysqli_query($koneksi, $sql)) {
        // Jika penghapusan berhasil, alihkan kembali ke halaman tampilan data
        header("Location: daftar_pengaduan.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan.";
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
