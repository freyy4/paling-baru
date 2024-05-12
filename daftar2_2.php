<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Riwayat Pendidikan</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
    $id_daftar = $_SESSION['id_daftar'];
    ?>
    <?php include "navbar1.php"; ?>
    <div class="container">
        <div class="card shadow-lg p-3 mb-5">
            <div class="card-body">
                <h2>Pendidikan</h2>
                <form method="post" action="daftar2_2.php" enctype="multipart/form-data">
                    <input type="hidden" name="id_daftar" value="<?php echo $id_daftar ?>">
                    <div class="table-container table-responsive">
                        <table class="table" id="education-table">
                            <thead>
                                <tr>
                                    <th>Nama Sekolah *</th>
                                    <th>Tanggal Masuk Sekolah *</th>
                                    <th>Tanggal Lulus Sekolah *</th>
                                    <th>Ijazah Sekolah *</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="education-row">
                                    <td>
                                        <input type="text" class="form-control nama-sekolah" name="nama_sekolah[]"
                                            placeholder="Masukkan Nama Sekolah" required>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control tgl-masuk" name="tgl_masuk_sekolah[]"
                                            required>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control tgl-lulus" name="tgl_lulus_sekolah[]"
                                            required>
                                    </td>
                                    <td>
                                        <input type="file" class="form-control ijazah-sekolah" name="ijazah_sekolah[]"
                                            required accept="image/*,application/pdf">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-success" id="add-row-btn">&plus; Tambah Sekolah</button>
                    <a href="dash.php" class="btn btn-warning"><< Kembali</a>
                </div>
                <button type="submit" class="btn btn-primary" name="daftar">Lanjut >></button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const addRowBtn = document.getElementById("add-row-btn");
        const tableBody = document.getElementById("education-table").getElementsByTagName('tbody')[0];

        addRowBtn.addEventListener("click", function() {
            const newRow = tableBody.insertRow(tableBody.rows.length - 1);
            newRow.className = 'education-row';
            newRow.innerHTML = `
                    <td>
                        <input type="text" class="form-control nama-sekolah" name="nama_sekolah[]" placeholder="Masukkan Nama Sekolah" required>
                    </td>
                    <td>
                        <input type="date" class="form-control tgl-masuk" name="tgl_masuk_sekolah[]" required>
                    </td>
                    <td>
                        <input type="date" class="form-control tgl-lulus" name="tgl_lulus_sekolah[]" required>
                    </td>
                    <td>
                        <input type="file" class="form-control ijazah-sekolah" name="ijazah_sekolah[]" required accept="image/*,application/pdf">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-row">Hapus</button>
                    </td>
                `;
        });

        tableBody.addEventListener("click", function(event) {
            if (event.target.classList.contains('remove-row')) {
                const row = event.target.closest('.education-row');
                row.remove();
            }
        });
    });
    </script>
</body>

</html>

<?php
if (isset($_POST['daftar'])) {
    include "koneksi.php";
    $nama_sekolahArr = $_POST['nama_sekolah'];
    $tgl_masuk_sekolahArr = $_POST['tgl_masuk_sekolah'];
    $tgl_lulus_sekolahArr = $_POST['tgl_lulus_sekolah'];
    $ijazah_sekolahArr = $_FILES['ijazah_sekolah'];

    $targetsekolah = "sekolah/";

    for ($i = 0; $i < count($nama_sekolahArr); $i++) {
        $nama_sekolah = mysqli_real_escape_string($koneksi, $nama_sekolahArr[$i]);
        $tgl_masuk_sekolah = $tgl_masuk_sekolahArr[$i];
        $tgl_lulus_sekolah = $tgl_lulus_sekolahArr[$i];

        $ijazah_sekolah = $targetsekolah . basename($ijazah_sekolahArr['name'][$i]);

        move_uploaded_file($ijazah_sekolahArr['tmp_name'][$i], $ijazah_sekolah);

        $insert = mysqli_query($koneksi, "INSERT INTO sekolah 
                        (id_daftar, nama_sekolah, tgl_masuk_sekolah, tgl_lulus_sekolah, ijazah_sekolah) VALUES 
                        ('$id_daftar', '$nama_sekolah', '$tgl_masuk_sekolah', '$tgl_lulus_sekolah', '$ijazah_sekolah');");
        $_SESSION['id_daftar'] = $id_daftar;
        if (!$insert) {
            die("Gagal menyimpan data");
        }
    }

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
}
?>