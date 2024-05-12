<?php
include "../koneksi.php";

// Array untuk menyimpan data per hari
$data_per_hari = array(
    'Senin' => 0,
    'Selasa' => 0,
    'Rabu' => 0,
    'Kamis' => 0,
    'Jumat' => 0,
    'Sabtu' => 0,
    'Minggu' => 0
);

// Query untuk mengambil data dari tabel untuk 1 minggu mendatang
$sql = "SELECT DAYNAME(updated_at) AS hari, COUNT(*) AS jumlah FROM daftar WHERE updated_at >= NOW() AND updated_at <= DATE_ADD(NOW(), INTERVAL 1 WEEK) GROUP BY DAYNAME(updated_at)";
$result = $koneksi->query($sql);

// Memeriksa apakah query berhasil dieksekusi
if ($result->num_rows > 0) {
    // Mengisi array dengan data yang diperoleh dari query
    while($row = $result->fetch_assoc()) {
        $data_per_hari[$row['hari']] = $row['jumlah'];
    }
}

// Menutup koneksi
$koneksi->close();

// Mengembalikan data dalam format JSON
echo json_encode($data_per_hari);
?>
