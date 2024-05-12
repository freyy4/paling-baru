<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Data Diri</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/@4.1.0-rc.0/dist/css/.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
                <h4>Biodata Diri</h4>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@4.1.0-rc.0/dist/js/.min.js"></script>

</body>
<?php
if (isset($_POST['daftar'])) {
    include "koneksi.php";
    $query_latest_id = "SELECT id_daftar FROM daftar ORDER BY id_daftar DESC LIMIT 1";
    $result_latest_id = mysqli_query($koneksi, $query_latest_id);

    $prefix = "CBM-PMI-";
    $next_number = 1;

    if (mysqli_num_rows($result_latest_id) > 0) {
        $latest_id = mysqli_fetch_assoc($result_latest_id)['id_daftar'];
        $latest_number = intval(substr($latest_id, strlen($prefix))); // Extract the numeric part
        $next_number = $latest_number + 1;
    }

    $id_daftar = $prefix . sprintf('%02d', $next_number);
    $nama_lengkap = $_POST['nama_lengkap'];
    $jk = $_POST['jk'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST["tgl_lahir"];
    $tinggi = $_POST['tinggi'];
    $berat = $_POST['berat'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $kecamatan = $_POST['kecamatan'];
    $desa = $_POST['desa'];
    $alamat_lengkap = $_POST['alamat_lengkap'];
    $insert = mysqli_query($koneksi, "INSERT INTO daftar 
    (id_daftar, nama_lengkap, jk, tempat_lahir, tgl_lahir, tinggi, berat, id_provinsi, id_kota, id_kecamatan, id_desa, alamat_lengkap) VALUES 
    ('$id_daftar', '$nama_lengkap', '$jk', '$tempat_lahir', '$tgl_lahir', '$tinggi', '$berat', '$provinsi', '$kota', '$kecamatan', '$desa', '$alamat_lengkap');");
    $_SESSION['id_daftar'] = $id_daftar;
    if ($insert) {
        echo "<script>
        Swal.fire({
            title: 'Data berhasil disimpan',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = 'dash.php';
            }
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Oops, Sepertinya ada masalah',
            icon: 'warning',
            confirmButtonText: 'Coba Lagi'
        });
        </script>";
        echo mysqli_error($koneksi);        
    }
}
?>

</html>