<?php
include '../koneksi.php';
$id_pengaduan = $_GET['id_pengaduan'];

// Ambil data dari database
$sql1 = "SELECT * FROM tindak_lanjut WHERE id_pengaduan = $id_pengaduan";
$result = mysqli_query($koneksi, $sql1);

// Header untuk membuat file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_pengaduan.xls");

echo "<table border='1'>
        <tr>
            <th>No</th>
            <th>Tanggal Tindak Lanjut</th>
            <th>Nama Admin</th>
            <th>Catatan</th>
        </tr>";

$no = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$no}</td>
            <td>{$row["tgl"]}</td>
            <td>{$row["input_oleh"]}</td>
            <td>{$row["catatan"]}</td>
          </tr>";
    $no++;
}

echo "</table>";

// Selesai
exit();
