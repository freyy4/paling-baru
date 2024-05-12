<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function hapus1(event) {
    event.preventDefault(); // Prevent the default link behavior

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user clicks "Ya, hapus!", proceed with the deletion
            window.location.href = event.target.href;
        }
    });
}

function hapus2(event) {
    event.preventDefault(); // Prevent the default link behavior

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user clicks "Ya, hapus!", proceed with the deletion
            window.location.href = event.target.href;
        }
    });
}

function hapus3(event) {
    event.preventDefault(); // Prevent the default link behavior

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user clicks "Ya, hapus!", proceed with the deletion
            window.location.href = event.target.href;
        }
    });
}

function logout(event) {
    event.preventDefault(); // Prevent the default link behavior

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
            // If the user clicks "Ya, hapus!", proceed with the deletion
            window.location.href = event.target.href;
        }
    });
}

function yakin(event) {
    event.preventDefault(); // Prevent the default link behavior

    Swal.fire({
        text: 'Apakah Anda yakin ingin mengubah data diri?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Ubah!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user clicks "Ya, hapus!", proceed with the deletion
            window.location.href = event.target.href;
        }
    });
}

function yakin1(event) {
    event.preventDefault(); // Prevent the default link behavior

    Swal.fire({
        text: 'Apakah Anda yakin ingin menghapus File ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user clicks "Ya, hapus!", proceed with the deletion
            window.location.href = event.target.href;
        }
    });
}

function alerta() {
    Swal.fire({
        title: "<h5>Selamat Datang</h5>",
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
</script>