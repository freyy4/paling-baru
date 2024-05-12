<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Edit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="cbm.png">
</head>

<body>
    <?php
    include 'navbar1.php';
    ?>
    <?php
    include 'koneksi.php';
    session_start();
    $id = $_GET['id'];
    $sql = "SELECT * FROM pengalaman WHERE id = '$id'";
    $data = mysqli_query($koneksi, $sql);
    while ($d = mysqli_fetch_array($data)) {
    ?>
    <div class="container card">
        <h2>Pengalaman</h2>
        <form action="edit_pengalaman1.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
            <div class="form-group">
                <label for="instansi">Perusahaan *</label>
                <input type="text" class="form-control" name="nama_perusahaan" placeholder="Masukkan Instansi"
                    value="<?php echo $d['nama_perusahaan']; ?>">
            </div>
            <div class="form-group">
                <label for="tgl_keluar_sertifikat">Tanggal Masuk Perusahaan *</label>
                <input type="date" class="form-control" name="tgl_masuk_perusahaan"
                    value="<?php echo $d['tgl_masuk_perusahaan']; ?>">
            </div>
            <div class="form-group">
                <label for="no_sertifikat">Tanggal Keluar dari Perusahaan *</label>
                <input type="date" class="form-control" name="tgl_keluar_perusahaan"
                    placeholder="Masukkan Nomor Sertifikat" value="<?php echo $d['tgl_keluar_perusahaan']; ?>">
            </div>
            <div class="form-group">
                <label for="jenis">Jenis Pekerjaan *</label>
                <input type="text" class="form-control" name="pekerjaan" placeholder="Masukkan Jenis Pelatihan"
                    value="<?php echo $d['pekerjaan']; ?>">
            </div>
            <div class="form-group">
                <label for="jenis">Jabatan *</label>
                <input type="text" class="form-control" name="jabatan" placeholder="Masukkan Jenis Pelatihan"
                    value="<?php echo $d['jabatan']; ?>">
            </div>
            <div class="form-group">
                <label for="uraian">Keterangan *</label>
                <textarea class="form-control" name="keterangan" placeholder="Masukkan Uraian Pelatihan"
                    rows="3"><?php echo $d['keterangan']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="file_sertifikat">File Sertifikasi *</label>
                <input type="file" class="form-control" name="file_sertifikasi" accept="image/*,application/pdf">
            </div>
            <input type="submit" value="Update" class="btn btn-primary form-control" name="update">
        </form>
        <?php } ?>
    </div>

    <?php
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $perusahaan = $_POST['nama_perusahaan'];
        $tgl_masuk_perusahaan = $_POST['tgl_masuk_perusahaan'];
        $tgl_keluar_perusahaan = $_POST['tgl_keluar_perusahaan'];
        $pekerjaan = $_POST['pekerjaan'];
        $jabatan = $_POST['jabatan'];
        $keterangan = $_POST['keterangan'];

        // Jika file diunggah
        if (!empty($_FILES['file_sertifikasi']['name'])) {
            // Direktori penyimpanan berkas
            $targetDir = "sertifikasi/";

            // Nama berkas (gunakan timestamp untuk menghindari nama berkas yang sama)
            $file_sertifikasi = $targetDir . $perusahaan . '_' . basename($_FILES['file_sertifikasi']['name']);

            // Pindahkan berkas ke direktori penyimpanan
            if (move_uploaded_file($_FILES['file_sertifikasi']['tmp_name'], $file_sertifikasi)) {
                // Lakukan query update dengan menyertakan kolom berkas
                $update = mysqli_query($koneksi, "UPDATE pengalaman SET nama_perusahaan = '$perusahaan', tgl_masuk_perusahaan = '$tgl_masuk_perusahaan', tgl_keluar_perusahaan = '$tgl_keluar_perusahaan', pekerjaan = '$pekerjaan', jabatan = '$jabatan', keterangan = '$keterangan', sertifikasi = '$file_sertifikasi' WHERE id = '$id';");

                if ($update) {
                    echo "<script>
                    Swal.fire({
                        title: 'Data berhasil disimpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = 'admin/admin.php';
                        }
                    });
                    </script>";
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            // Jika tidak ada file diunggah, lakukan query update tanpa menyertakan kolom berkas
            $update = mysqli_query($koneksi, "UPDATE pengalaman SET nama_perusahaan = '$perusahaan', tgl_masuk_perusahaan = '$tgl_masuk_perusahaan', tgl_keluar_perusahaan = '$tgl_keluar_perusahaan', pekerjaan = '$pekerjaan', jabatan = '$jabatan', keterangan = '$keterangan' WHERE id = '$id';");

            if ($update) {
                echo "<script>
                alert('Data berhasil diperbarui 😁');
                window.location='admin/admin.php';
                </script>";
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
        }
    }
?>
    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>