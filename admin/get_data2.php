<?php
include "../koneksi.php";

// Array untuk menyimpan data per minggu
$data_per_minggu = array();

// Query untuk mengambil data dari tabel per minggu (minggu pertama hingga minggu kelima)
for ($minggu = 1; $minggu <= 5; $minggu++) {
    // Menghitung tanggal awal dan akhir untuk minggu ini
    $tanggal_awal = date('Y-m-d', strtotime("monday this week +".($minggu - 1)." week"));
    $tanggal_akhir = date('Y-m-d', strtotime("friday this week +".($minggu - 1)." week"));

    // Query untuk mengambil data per minggu
    $sql = "SELECT COUNT(*) AS jumlah FROM daftar WHERE updated_at >= '$tanggal_awal' AND updated_at <= '$tanggal_akhir'";
    $result = $koneksi->query($sql);

    // Memeriksa apakah query berhasil dieksekusi
    if ($result->num_rows > 0) {
        // Mengambil jumlah pendaftaran untuk minggu ini
        $row = $result->fetch_assoc();
        $data_per_minggu["Minggu $minggu"] = $row['jumlah'];
    } else {
        // Jika tidak ada data, maka jumlahnya 0
        $data_per_minggu["Minggu $minggu"] = 0;
    }
}

// Menutup koneksi
$koneksi->close();

// Mengembalikan data dalam format JSON
echo json_encode($data_per_minggu);
?>
