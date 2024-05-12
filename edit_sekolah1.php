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
    $sql = "SELECT * FROM sekolah WHERE id = '$id'";
    $data = mysqli_query($koneksi, $sql);
    while ($d = mysqli_fetch_array($data)) {
    ?>
    <div class="container card">
        <h2>Pendidikan/Sekolah</h2>
        <form action="edit_sekolah1.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
            <div class="form-group">
                <label for="nama_sekolah">Nama Sekolah:</label>
                <input type="text" class="form-control" name="nama_sekolah" value="<?php echo $d['nama_sekolah']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="tgl_masuk_sekolah">Tanggal Masuk Sekolah:</label>
                <input type="date" class="form-control" name="tgl_masuk_sekolah"
                    value="<?php echo $d['tgl_masuk_sekolah']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tgl_lulus_sekolah">Tanggal Lulus Sekolah:</label>
                <input type="date" class="form-control" name="tgl_lulus_sekolah"
                    value="<?php echo $d['tgl_lulus_sekolah']; ?>" required>
            </div>
            <div class="form-group">
                <label for="ijazah_sekolah">Ijazah Sekolah:</label>
                <input type="file" class="form-control-file" name="ijazah_sekolah" accept="image/*,application/pdf">
            </div>
            <input type="submit" value="Update" class="btn btn-primary form-control" name="update">
        </form>
        <?php } ?>
    </div>

    <?php
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama_sekolah = $_POST['nama_sekolah'];
        $tgl_masuk_sekolah = $_POST['tgl_masuk_sekolah'];
        $tgl_lulus_sekolah = $_POST['tgl_lulus_sekolah'];

        // Jika file diunggah
        if (!empty($_FILES['ijazah_sekolah']['name'])) {
            // Direktori penyimpanan berkas
            $targetDir = "sekolah/";

            // Nama berkas (gunakan timestamp untuk menghindari nama berkas yang sama)
            $ijazah_sekolah = $targetDir . time() . '_' . basename($_FILES['ijazah_sekolah']['name']);

            // Pindahkan berkas ke direktori penyimpanan
            if (move_uploaded_file($_FILES['ijazah_sekolah']['tmp_name'], $ijazah_sekolah)) {
                // Lakukan query update dengan menyertakan kolom berkas
                $update = mysqli_query($koneksi, "UPDATE sekolah SET nama_sekolah = '$nama_sekolah', tgl_masuk_sekolah = '$tgl_masuk_sekolah', tgl_lulus_sekolah = '$tgl_lulus_sekolah', ijazah_sekolah = '$ijazah_sekolah' WHERE id = '$id';");

                if ($update) {
                    echo "<script>
            alert('Data berhasil diperbarui 😁');
            window.location='admin/admin.php';
            </script>";
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            // Jika tidak ada file diunggah, lakukan query update tanpa menyertakan kolom berkas
            $update = mysqli_query($koneksi, "UPDATE sekolah SET nama_sekolah = '$nama_sekolah', tgl_masuk_sekolah = '$tgl_masuk_sekolah', tgl_lulus_sekolah = '$tgl_lulus_sekolah' WHERE id = '$id';");

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
        }
    }
    ?>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>