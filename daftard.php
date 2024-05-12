<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Pelatihan</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
</head>

<body>
    <?php
    $id_daftar = $_SESSION['id_daftar'];
    $id = $_SESSION['id'];
    ?>
    <?php include "navbar2.php"; ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active text-success" aria-current="page">Data Diri</li>
            <li class="breadcrumb-item active text-success" aria-current="page">Riwayat Pendidikan</li>
            <li class="breadcrumb-item active text-success" aria-current="page">Pengalaman Bekerja</li>
            <li class="breadcrumb-item active" aria-current="page">Pelatihan</li>
        </ol>
    </nav>
    <div class="container">
        <div class="card shadow-lg p-3 mb-5">
            <div class="card-body">
                <h2>Sertifikat Pelatihan</h2>
                <a href="admin/admin.php" class="btn btn-danger">Lewati Jika tidak punya Pelatihan</a>
                <form method="post" action="daftard.php" enctype="multipart/form-data">
                    <input type="hidden" name="id_daftar" value="<?php echo $id_daftar ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="table-container table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sertifikat Pelatihan</th>
                                    <th>Instansi yang mengeluarkan Sertifikat</th>
                                    <th>Tanggal Pengeluaran Sertifikat</th>
                                    <th>Nomor Sertifikat</th>
                                    <th>Jenis Sertifikat</th>
                                    <th>Uraian</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <tr>
                                    <td>
                                        <input type="file" class="form-control" name="sertifikat[]" multiple accept="image/*,application/pdf">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="instansi[]" multiple>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="tgl_keluar_sertifikat[]" multiple>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="no_sertifikat[]" multiple>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="jenis[]" multiple>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="uraian[]" multiple>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success" id="add-row-btn">&plus; Tambah
                            Baris</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="daftar">Lanjut >></button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    function yakin() {
        return alert("Apa Anda Yakin Ingin Keluar?");
    }
    $(document).ready(function() {
        $(".select2").select2({
            tags: true,
            placeholder: function() {
                $(this).data('placeholder');
            },
            tokenSeparators: [',']
        });

        const addRowBtn = document.getElementById("add-row-btn");
        const tableBody = document.getElementById("table-body");

        addRowBtn.addEventListener("click", function() {
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                    <td>
                        <input type="file" class="form-control" name="sertifikat[]" multiple accept="image/*,application/pdf">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="instansi[]" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_keluar_sertifikat[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="no_sertifikat[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="jenis[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="uraian[]" multiple>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-row">Hapus</button>
                    </td>
                `;

            tableBody.appendChild(newRow);
            $(".select2").select2({
                tags: true,
                placeholder: function() {
                    $(this).data('placeholder');
                },
                tokenSeparators: [',']
            });
            document.querySelector('form').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-row')) {
                    const row = event.target.closest('tr');
                    row.remove();
                }
            });
        });
    });
    </script>

</body>

</html>

<?php
if (isset($_POST['daftar'])) {
    // Ambil data dari formulir
    $id = $_POST['id'];
    $id_daftar = $_POST['id_daftar'];
    $instansiArr = $_POST['instansi'];
    $tgl_keluar_sertifikatArr = $_POST['tgl_keluar_sertifikat'];
    $no_sertifikatArr = $_POST['no_sertifikat'];
    $jenisArr = $_POST['jenis'];
    $uraianArr = $_POST['uraian'];

    // Mengatur lokasi penyimpanan file sertifikat
    $target_dir = "sertifikat/";

    // Proses multiple insert
    include "koneksi.php";

    for ($i = 0; $i < count($instansiArr); $i++) {
        $instansi = mysqli_real_escape_string($koneksi, $instansiArr[$i]);
        $tgl_keluar_sertifikat = mysqli_real_escape_string($koneksi, $tgl_keluar_sertifikatArr[$i]);
        $no_sertifikat = mysqli_real_escape_string($koneksi, $no_sertifikatArr[$i]);
        $jenis = mysqli_real_escape_string($koneksi, $jenisArr[$i]);
        $uraian = mysqli_real_escape_string($koneksi, $uraianArr[$i]);

        $sertifikat = $target_dir . basename($_FILES['sertifikat']['name'][$i]);

        if (move_uploaded_file($_FILES['sertifikat']['tmp_name'][$i], $sertifikat)) {
            $insert = mysqli_query($koneksi, "INSERT INTO pelatihan (id_daftar, instansi, sertifikat, tgl_keluar_sertifikat, no_sertifikat, jenis, uraian) 
                                              VALUES ('$id_daftar', '$instansi', '$sertifikat', '$tgl_keluar_sertifikat', '$no_sertifikat', '$jenis', '$uraian');");
            $insert2 = mysqli_query($koneksi, "UPDATE login SET id_daftar='$id_daftar' WHERE id='$id';");
            $_SESSION['id_daftar'] = $id_daftar;
            if (!$insert and !$insert2) {
                die("Gagal menyimpan data");
            }
        } else {
            die("Gagal mengupload file sertifikat");
        }
    }


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
}
?>