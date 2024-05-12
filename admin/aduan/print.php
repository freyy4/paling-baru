<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Verifikasi | Data Pengaduan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style>
        @media print {
            @page {
                size: landscape;
            }
        }
    </style>

</head>

<body>
    <?php
    include '../../koneksi.php';
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../login_admin.php");
    }
    ?>
    <h3>Data Pengaduan</h3>
    <div class="table">
        <table id="mydata" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Induk Kependudukan</th>
                    <th>Nama Lengkap Pengaduan</th>
                    <th>Email Pengaduan</th>
                    <th>Nomor HP Pengaduan</th>
                    <th>Hubungan dengan PMI</th>
                    <th>Uraian Permasalahan</th>
                    <th>Nomor Induk Kependudukan PMI</th>
                    <th>Nama Lengkap PMI</th>
                    <th>Alamat Lengkap PMI </th>
                    <th>Tanggal Terbang</th>
                    <th>Negara Tujuan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../koneksi.php';
                $sql1 = "SELECT * FROM pengaduan";
                $result = mysqli_query($koneksi, $sql1);
                $no = 1;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row["nik"]; ?></td>
                            <td><?php echo $row["nama_lengkap"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["nomor_hp"]; ?></td>
                            <td><?php echo $row["hubungan_pm"]; ?></td>
                            <td><?php echo $row["permasalahan"]; ?></td>
                            <td><?php echo $row["nik_pmi"]; ?></td>
                            <td><?php echo $row["nama_pmi"]; ?></td>
                            <td><?php echo $row["alamat_pmi"]; ?></td>
                            <td><?php echo $row["tgl_terbang"]; ?></td>
                            <td><?php echo $row["negara_tujuan"]; ?></td>
                            <td><?php echo $row["selesai"]; ?></td>
                        </tr>

                <?php
                    }
                }

                $koneksi->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    window.print()
</script>

</html>