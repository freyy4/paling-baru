<?php
include '../../koneksi.php';

// Ambil data dari database
$sql1 = "SELECT * FROM pengaduan";
$result = mysqli_query($koneksi, $sql1);

// Header untuk membuat file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_pengaduan.xls");

echo "<table border='1'>
        <tr>
            <th>No</th>
            <th>Nomor Induk Kependudukan</th>
            <th>Nama Lengkap Pengaduan</th>
            <th>Email Pengaduan</th>
            <th>Nomor HP Pengaduan</th>
            <th>Hubungan dengan PMI</th>
            <th>Uraian Permasalahan</th>
            <th>Nomor Induk Kependudukan PMI</th>
            <th>Nama Lengkap PMI</th>
            <th>Alamat Lengkap PMI</th>
            <th>Tanggal Terbang</th>
            <th>Negara Tujuan</th>
            <th>Status</th>
        </tr>";

$no = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$no}</td>
            <td>{$row["nik"]}</td>
            <td>{$row["nama_lengkap"]}</td>
            <td>{$row["email"]}</td>
            <td>{$row["nomor_hp"]}</td>
            <td>{$row["hubungan_pm"]}</td>
            <td>{$row["permasalahan"]}</td>
            <td>{$row["nik_pmi"]}</td>
            <td>{$row["nama_pmi"]}</td>
            <td>{$row["alamat_pmi"]}</td>
            <td>{$row["tgl_terbang"]}</td>
            <td>{$row["negara_tujuan"]}</td>
            <td>{$row["selesai"]}</td>
          </tr>";
    $no++;
}

echo "</table>";

// Selesai
exit();
