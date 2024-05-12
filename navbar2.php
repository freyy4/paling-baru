<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-dark small-navbar shadow rounded-navbar">
        <div class="container">
            <a class="navbar-brand" href="#" style="color: black; font-weight: bold;">
                <img src="https://ptcbm.id/wp-content/uploads/2023/03/logo-pt-cbm-white.png"
                    width="50" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <img src="https://cdn.icon-icons.com/icons2/933/PNG/512/sort-button-with-three-lines_icon-icons.com_72539.png"
                    width="20" height="20">
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto" style="font-size:15px;">
                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="admin/admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="logout.php"
                            onclick="return logout(event)">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function alerta() {
        Swal.fire({
            title: "<h4>Selamat Datang</h4>",
            icon: "info",
            html: `
            <div style="text-align:left;">
                <p>Simak dulu ya, prosedur pendaftarannya</p>
                <strong>Prosedur Pendaftaran</strong>
                <ol>
                    <li><strong>Pendaftaran dan Seleksi</strong></li>
                    <p>Calon Pekerja Migran (CPMI) yang ingin bekerja di Taiwan dan Hongkong harus mendaftar
                        di PT. Crystal Biru Meuligo yang telah memiliki <a href="https://ptcbm.id/#perizinan"
                            target="_blank">izin resmi dari Kementerian
                            Ketenagakerjaan.</a></p>
                    <li><strong>Cek Dokumen</strong></li>
                    <p>Setelah lulus seleksi, calon pekerja migran Indonesia harus melengkapi dokumen yang
                        dibutuhkan, seperti paspor, identitas diri (KTP, KK, AKTE, Surat izin orang
                        tua/suami) dan sertifikat keahlian dari Lembaga Pelatihan Kerja (LPK).</p>
                    <li><strong>Penempatan dan Pelatihan</strong></li>
                    <p>Setelah dokumen lengkap, calon pekerja migran akan ditempatkan di negara tujuan
                        (Taiwan atau Hongkong).</p>
                    <li><strong>Keberangkatan</strong></li>
                    <p>Setelah semua proses selesai, Calon Pekerja Migran Indonesia (CPMI) akan
                        diberangkatkan ke negara tujuan penempatan dan akan dijemput oleh perwakilan mitra
                        perusahaan (Agency).</p>
                </ol>
            </div>
        `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Ok',
        });
    }

    function logout(event) {
        event.preventDefault();

        Swal.fire({
            text: 'Apakah Anda yakin ingin Keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = event.target.href;
            }
        });
    }
    </script>
    <script src="script.js"></script>

</body>

</html>