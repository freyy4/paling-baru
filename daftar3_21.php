<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Pengalaman Bekerja</title>
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
                <h2>Pengalaman Bekerja</h2>
                <form method="post" action="daftar3_21.php" enctype="multipart/form-data">
                    <input type="hidden" name="id_daftar" value="<?php echo $id_daftar ?>">
                    <div class="table-container table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Perusahaan</th>
                                    <th>Tanggal Masuk Perusahaan</th>
                                    <th>Tanggal Keluar Perusahaan</th>
                                    <th>Pekerjaan</th>
                                    <th>Jabatan</th>
                                    <th>Keterangan Pekerjaan</th>
                                    <th>Sertifikasi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="nama_perusahaan[]"
                                            placeholder="Masukkan Nama Perusahaan" multiple>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="tgl_masuk_perusahaan[]" multiple>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="tgl_keluar_perusahaan[]" multiple>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="pekerjaan[]"
                                            placeholder="Masukkan Nama Pekerjaan" multiple>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="jabatan[]"
                                            placeholder="Masukkan Nama Jabatan" multiple>
                                    <td>
                                        <textarea class="form-control" name="keterangan[]" rows="3"
                                            placeholder="Masukkan Keterangan Pekerjaan Anda (Tidak harus diisi)"></textarea>
                                    </td>
                                    <td>
                                        <input type="file" class="form-control" name="sertifikasi[]" multiple accept="image/*,application/pdf">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success" id="add-row-btn">&plus; Tambah
                            Baris</button>
                        <a href="admin/admin.php" class="btn btn-warning"><< Kembali</a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="daftar">Lanjut >></button>
            </form>
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
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
                        <input type="text" class="form-control" name="nama_perusahaan[]" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_masuk_perusahaan[]" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_keluar_perusahaan[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="pekerjaan[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="jabatan[]" multiple>
                    <td>
                        <textarea class="form-control" name="keterangan[]" rows="3" placeholder="Masukkan Keterangan Pekerjaan Anda (Tidak harus diisi)"></textarea>
                    </td>
                    <td>
                        <input type="file" class="form-control" name="sertifikasi[]" multiple accept="image/*,application/pdf">
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
    include "koneksi.php";

    $id_daftar = mysqli_real_escape_string($koneksi, $_POST['id_daftar']);
    $nama_perusahaanArr = $_POST['nama_perusahaan'];
    $tgl_masuk_perusahaanArr = $_POST['tgl_masuk_perusahaan'];
    $tgl_keluar_perusahaanArr = $_POST['tgl_keluar_perusahaan'];
    $pekerjaanArr = $_POST['pekerjaan'];
    $jabatanArr = $_POST['jabatan'];
    $keteranganArr = $_POST['keterangan'];
    $sertifikasiArr = $_FILES['sertifikasi'];

    for ($i = 0; $i < count($nama_perusahaanArr); $i++) {
        $nama_perusahaan = mysqli_real_escape_string($koneksi, $nama_perusahaanArr[$i]);
        $tgl_masuk_perusahaan = mysqli_real_escape_string($koneksi, $tgl_masuk_perusahaanArr[$i]);
        $tgl_keluar_perusahaan = mysqli_real_escape_string($koneksi, $tgl_keluar_perusahaanArr[$i]);
        $pekerjaan = mysqli_real_escape_string($koneksi, $pekerjaanArr[$i]);
        $jabatan = mysqli_real_escape_string($koneksi, $jabatanArr[$i]);
        $keterangan = mysqli_real_escape_string($koneksi, $keteranganArr[$i]);

        $target_dir = "sertifikasi/";
        $sertifikasi = $target_dir . basename($sertifikasiArr['name'][$i]);
        move_uploaded_file($sertifikasiArr['tmp_name'][$i], $sertifikasi);

        $insert = mysqli_query($koneksi, "INSERT INTO pengalaman (id_daftar, nama_perusahaan, tgl_masuk_perusahaan, tgl_keluar_perusahaan, pekerjaan, jabatan, keterangan, sertifikasi) VALUES ('$id_daftar', '$nama_perusahaan', '$tgl_masuk_perusahaan', '$tgl_keluar_perusahaan', '$pekerjaan', '$jabatan', '$keterangan', '$sertifikasi');");
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
            window.location = 'admin/dash.php';
        }
    });
</script>";
}
?>