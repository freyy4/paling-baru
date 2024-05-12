<?php
require 'vendor/autoload.php'; 
use Dompdf\Dompdf;
use Dompdf\Options;
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('defaultFont', 'Tahoma');
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Print Pendaftaran</title>
    <style>
    body {
        font-family: 'Tahoma', sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    p,
    strong {
        font-size: 10px;
    }

    strong {
        font-weight: bold;
    }

    .btn {
        display: none;
    }

    @media print {
        body * {
            visibility: visible;
        }

        .btn {
            display: none;
        }
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #stickyElement,
        #stickyElement * {
            visibility: hidden;
        }

        .main-panel,
        .content-wrapper,
        .container-scroller {
            margin: 0;
            width: 100%;
            padding: 0;
        }

        .card {
            box-shadow: none;
            border: none;
        }

        .btn {
            display: none;
        }
    }

    td {
        width: 200px;
        /* Atur lebar sesuai kebutuhan */
    }

    th {
        text-align: left;
    }
    </style>
    <link rel="shortcut icon" href="assets/images/Screenshot__3_-removebg-preview.png" />
</head>

<body>

    <?php
    session_start();

    if (empty($_SESSION['login'])) {
        header("Location:../index.php");
    }

    include 'koneksi.php';
    
    if (isset($_GET['id_daftar'])) {
        $id_daftar = $_GET['id_daftar'];
        $_SESSION['id_daftar'] = $id_daftar;
        if (strpos($id_daftar, 'CBM-PMI-') === 0) {
            $sql = "SELECT d.id_daftar, d.nik, d.nama_lengkap, d.email, d.medsos, d.jk, d.status, d.kk, d.akte_kelahiran, d.akte_cerai, d.buku_nikah, d.foto_ktp, d.selfie_ktp, d.pas, d.telepon, d.video, d.tempat_lahir, d.tgl_lahir, d.tinggi, d.berat, d.pekerjaan, d.negara, p.nama AS provinsi, k.nama AS kota, kc.nama AS kecamatan, ds.nama AS desa, d.alamat_lengkap 
            FROM daftar d 
            JOIN provinsi p ON d.id_provinsi = p.id_provinsi 
            JOIN kota k ON d.id_kota = k.id_kota 
            JOIN kecamatan kc ON d.id_kecamatan = kc.id_kecamatan 
            JOIN desa ds ON d.id_desa = ds.id_desa 
            WHERE d.id_daftar=?";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("s", $id_daftar);
            $stmt->execute();
            $result = $stmt->get_result();
            $row1 = $result->fetch_assoc();

            $sql2 = "SELECT * FROM sekolah WHERE id_daftar=?";
            $stmt2 = $koneksi->prepare($sql2);
            $stmt2->bind_param("s", $id_daftar);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            $data_sekolah = array();  //Array untuk menyimpan data sekolah

            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {
                    $data_sekolah[] = array(
                        'nama_sekolah' => $row['nama_sekolah'],
                        'tgl_masuk_sekolah' => $row['tgl_masuk_sekolah'],
                        'tgl_lulus_sekolah' => $row['tgl_lulus_sekolah'],
                        'ijazah_sekolah' => $row['ijazah_sekolah']
                    );
                }
            }

            $sql3 = "SELECT * FROM pengalaman WHERE id_daftar=?";
            $stmt3 = $koneksi->prepare($sql3);
            $stmt3->bind_param("s", $id_daftar);
            $stmt3->execute();
            $result3 = $stmt3->get_result();

            $data_pengalaman = array();  //Array untuk menyimpan data pengalaman

            if ($result3->num_rows > 0) {
                while ($row = $result3->fetch_assoc()) {
                    $data_pengalaman[] = array(
                        'nama_perusahaan' => $row['nama_perusahaan'],
                        'tgl_masuk_perusahaan' => $row['tgl_masuk_perusahaan'],
                        'tgl_keluar_perusahaan' => $row['tgl_keluar_perusahaan'],
                        'pekerjaan' => $row['pekerjaan'],
                        'jabatan' => $row['jabatan'],
                        'keterangan' => $row['keterangan'],
                        'sertifikasi' => $row['sertifikasi']
                    );
                }
            }

            $sql4 = "SELECT * FROM pelatihan WHERE id_daftar=?";
            $stmt4 = $koneksi->prepare($sql4);
            $stmt4->bind_param("s", $id_daftar);
            $stmt4->execute();
            $result4 = $stmt4->get_result();

            $data_pelatihan = array();  //Array untuk menyimpan data pelatihan

            if ($result4->num_rows > 0) {
                while ($row = $result4->fetch_assoc()) {
                    $data_pelatihan[] = array(
                        'instansi' => $row['instansi'],
                        'tgl_keluar_sertifikat' => $row['tgl_keluar_sertifikat'],
                        'no_sertifikat' => $row['no_sertifikat'],
                        'jenis' => $row['jenis'],
                        'uraian' => $row['uraian'],
                        'sertifikat' => $row['sertifikat']
                    );
                }
            }
            $sql5 = "SELECT * FROM vaksin WHERE id_daftar=?";
            $stmt5 = $koneksi->prepare($sql5);
            $stmt5->bind_param("s", $id_daftar);
            $stmt5->execute();
            $result5 = $stmt5->get_result();
    
            $data_vaksin = array(); // Array untuk menyimpan data pelatihan
    
            if ($result5->num_rows > 0) {
                while ($row = $result5->fetch_assoc()) {
                    $data_vaksin[] = array(
                        'sertifikat_vaksin' => $row['sertifikat_vaksin'],
                        'jenis_vaksin' => $row['jenis_vaksin']
                    );
                }
            }
            $stmt->close();
            $stmt2->close();
            $stmt3->close();
            $stmt4->close();
            $stmt5->close();
            $koneksi->close();
        } else {
            echo "ID Daftar tidak valid.";
        }
    }
    ?>

    <table>
        <tr>
            <td style="width:auto;">
                <img src="https://ptcbm.id/wp-content/uploads/2023/03/cropped-Logo-PT-CBM-cropped-100-×-100-px-180x180.png"
                    width="70px" height="70px" alt="PT CBM Logo">
            </td>
            <td style="width:270px;">
                <h3 style="margin-bottom: 0;">PT. CRYSTAL <span style="color:blue;">BIRU</span> MEULIGO</h3>
                <p>FORMULIR PENDAFTARAN FORMAL</p>
            </td>
        </tr>
    </table>


    <h5>1. Data Diri</h5>
    <div class="preview-list">
        <div>
            <?php if ($row1) : ?>
            <table style="border: 1px solid black;">
                <tbody>
                    <tr>
                        <td>
                            <strong>Daftar ID</strong>
                            <p><?php echo $row1['id_daftar']; ?></p>
                        </td>
                        <td>
                            <strong>Nama Lengkap</strong>
                            <p><?php echo $row1['nama_lengkap']; ?></p>
                        </td>
                        <td>
                            <strong>Nomor Induk Kependudukan</strong>
                            <p><?php echo $row1['nik']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Tempat/Tanggal Lahir</strong>
                            <p><?php echo $row1['tempat_lahir']; ?>, <?php echo $row1['tgl_lahir']; ?></p>
                        </td>
                        <td>
                            <strong>Status Perkawinan</strong>
                            <p><?php echo $row1['status']; ?></p>
                        </td>
                        <td>
                            <strong>Tinggi Badan</strong>
                            <p><?php echo $row1['tinggi']; ?> cm</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Berat Badan</strong>
                            <p><?php echo $row1['berat']; ?> kg</p>
                        </td>
                        <td>
                            <strong>Provinsi</strong>
                            <p><?php echo $row1['provinsi']; ?></p>
                        </td>
                        <td>
                            <strong>Kabupaten/Kota</strong>
                            <p><?php echo $row1['kota']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Kecamatan</strong>
                            <p><?php echo $row1['kecamatan']; ?></p>
                        </td>
                        <td>
                            <strong>Desa/Kelurahan</strong>
                            <p><?php echo $row1['desa']; ?></p>
                        </td>
                        <td>
                            <strong>Jenis Kelamin</strong>
                            <p><?php echo $row1['jk']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Email</strong>
                            <p><?php echo $row1['email']; ?></p>
                        </td>
                        <td>
                            <strong>Nomor Telepon</strong>
                            <p><?php echo $row1['telepon']; ?></p>
                        </td>
                        <td>
                            <strong>Nomor Telepon</strong>
                            <p><?php echo $row1['telepon']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Jenis Pekerjaan yang dipilih</strong>
                            <p><?php echo $row1['pekerjaan']; ?></p>
                        </td>
                        <td>
                            <strong>Negara yang dipilih</strong>
                            <p><?php echo $row1['negara']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php endif; ?>

            <h5>2. Riwayat Pendidikan</h5>
            <?php if (!empty($data_sekolah)) : ?>
            <table style="border: 1px solid black;">
                <thead>
                    <tr>
                        <th><strong>Nama Sekolah</strong></th>
                        <th><strong>Tanggal Masuk Sekolah</strong></th>
                        <th><strong>Tanggal Lulus Sekolah</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_sekolah as $sekolah) : ?>
                        <tr>
                            <td>
                                <?php if (!empty($sekolah['nama_sekolah'])) : ?>
                                <p><?php echo $sekolah['nama_sekolah']; ?></p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($sekolah['tgl_masuk_sekolah'])) : ?>
                                <p><?php echo $sekolah['tgl_masuk_sekolah']; ?></p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($sekolah['tgl_lulus_sekolah'])) : ?>
                                <p><?php echo $sekolah['tgl_lulus_sekolah']; ?></p>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
            <?php endif; ?>

            <h5>3. Pengalaman Bekerja</h5>
            <?php if (!empty($data_pengalaman)) : ?>
            <table>
                <?php foreach ($data_pengalaman as $pengalaman) : ?>
                <tbody style="border: 1px solid black;">
                    <tr>
                        <td>
                            <strong>Nama Perusahaan:</strong>
                            <p><?php echo $pengalaman['nama_perusahaan']; ?></p>
                        </td>
                        <td>
                            <strong>Tanggal Masuk Perusahaan:</strong>
                            <p><?php echo $pengalaman['tgl_masuk_perusahaan']; ?></p>
                        </td>
                        <td>
                            <strong>Tanggal Keluar Perusahaan:</strong>
                            <p><?php echo $pengalaman['tgl_masuk_perusahaan']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Pekerjaan:</strong>
                            <p><?php echo $pengalaman['pekerjaan']; ?></p>
                        </td>
                        <td>
                            <strong>Jabatan:</strong>
                            <p><?php echo $pengalaman['jabatan']; ?></p>
                        </td>
                    </tr>
                </tbody><br>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>

            <h5>4. Pelatihan</h5>
            <?php if (!empty($data_pelatihan)) : ?>
            <table>
                <?php foreach ($data_pelatihan as $pelatihan) : ?>
                <tbody style="border: 1px solid black;">
                    <tr>
                        <td>
                            <strong>Nama Instansi:</strong>
                            <p><?php echo $pelatihan['instansi']; ?></p>
                        </td>
                        <td>
                            <strong>Tanggal Keluar Sertifikat:</strong>
                            <p><?php echo $pelatihan['tgl_keluar_sertifikat']; ?></p>
                        </td>
                        <td>
                            <strong>Nomor Sertifikat:</strong>
                            <p><?php echo $pelatihan['no_sertifikat']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Jenis Sertifikat:</strong>
                            <p><?php echo $pelatihan['jenis']; ?></p>
                        </td>
                        <td>
                            <strong>Uraian Sertifikat:</strong>
                            <p><?php echo $pelatihan['uraian']; ?></p>
                        </td>
                    </tr>
                </tbody><br>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="https:cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script>
    $(document).ready(function() {
        $('#mydata').DataTable({
            "paging": false,
            "info": false,
            "language": {
                "infoEmpty": 'Tidak ada Data',
                "zeroRecords": 'Belum ada tindakan apapun',
                "lengthMenu": 'Lihat _MENU_ rekaman per halaman',
                "search": 'Cari',
            }
        });
    }); <
    script >
        <?php
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('data.pdf', ['Attachment' => false]);
exit;
?>