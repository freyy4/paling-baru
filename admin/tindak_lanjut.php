<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include '../koneksi.php';
    $id_pengaduan = $_GET['id_pengaduan'];
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../index.php");
    }
    ?>
    <div class="container-fluid">
        <form action="tindak_lanjut.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_pengaduan" value="<?php echo $id_pengaduan ?>">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Admin atau Email</th>
                        <th>Catatan</th>
                        <th>Dokumen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="entry">
                        <td>
                            <input type="date" name="date[]" class="form-control tanggal">
                        </td>
                        <td>
                            <input type="text" name="input_oleh[]" class="form-control" value="<?php echo $_SESSION["email"]; ?>">
                        </td>
                        <td>
                            <input type="text" name="catatan[]" class="form-control">
                        </td>
                        <td>
                            <input type="file" name="dokumen[]" class="form-control">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger removeRow">&minus; Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="addRow" class="btn btn-primary">&plus; Tambah Baris</button>
            <input type="submit" value="Selesai" class="btn btn-success">
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        // Fungsi untuk mengisi tanggal hari ini secara otomatis
        function setTanggalHariIni(inputTanggal) {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();

            var tanggalHariIni = yyyy + '-' + mm + '-' + dd;

            // Setel nilai input tanggal ke tanggal hari ini
            inputTanggal.value = tanggalHariIni;
        }
        $(document).ready(function() {
            $("#addRow").click(function() {
                var newRow = '<tr class="entry">' +
                    '<td><input type="date" name="date[]" class="form-control tanggal" value="<?php echo date('Y-m-d'); ?>"></td>' +
                    '<td><input type="text" name="input_oleh[]" class="form-control" value="<?php echo $_SESSION["email"]; ?>"></td>' +
                    '<td><input type="text" name="catatan[]" class="form-control"></td>' +
                    '<td><input type="file" name="dokumen[]" class="form-control"></td>' +
                    '<td><button type="button" class="btn btn-danger removeRow">&minus; Hapus</button></td>' +
                    '</tr>';
                $('tbody').append(newRow);
            });

            // Hapus baris saat tombol Hapus diklik
            $('tbody').on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
            });
        });

        // Panggil fungsi setTanggalHariIni untuk tanggal pada baris pertama saat halaman dimuat
        setTanggalHariIni(document.querySelector('.tanggal'));
    </script>

</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "koneksi.php";

    $id_pengaduan = $_POST['id_pengaduan'];
    $input_olehArr = $_POST['input_oleh'];
    $dateArr = $_POST['date'];
    $catatanArr = $_POST['catatan'];
    $dokumenArr = $_FILES['dokumen'];
    $targetdokumen = "dokumen/";

    // Loop melalui entri yang dikirimkan
    for ($i = 0; $i < count($input_olehArr); $i++) {
        $id_pengaduan = mysqli_real_escape_string($koneksi, $id_pengaduan);
        $input_oleh = mysqli_real_escape_string($koneksi, $input_olehArr[$i]);
        $date = $dateArr[$i];
        $catatan = mysqli_real_escape_string($koneksi, $catatanArr[$i]);

        // Menggunakan timestamp untuk nama file unik
        $timestamp = time();
        $dokumen = $targetdokumen . $timestamp . '_' . basename($dokumenArr['name'][$i]);

        move_uploaded_file($dokumenArr['tmp_name'][$i], $dokumen);

        $insert = mysqli_query($koneksi, "INSERT INTO tindak_lanjut 
                        (id_pengaduan, tgl, input_oleh, catatan, dokumen) VALUES 
                        ('$id_pengaduan', '$date', '$input_oleh', '$catatan', '$dokumen');");

        if (!$insert) {
            die("Gagal menyimpan data");
        }
    }

    echo "<script>
        alert('Data berhasil disimpan 😁');
        window.location='daftar_tindak_lanjut.php?id_pengaduan=$id_pengaduan';
        </script>";
}
