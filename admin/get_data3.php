<?php
include "../koneksi.php";
$query = "SELECT DATE_FORMAT(updated_at, '%M %Y') AS bulan, COUNT(id) AS jumlah_data FROM daftar GROUP BY DATE_FORMAT(updated_at, '%Y%m')";
$result = mysqli_query($koneksi, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
echo json_encode($data);
mysqli_close($koneksi);
?>