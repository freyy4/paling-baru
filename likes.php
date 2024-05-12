<?php include "head.php"; ?>
<?php
    session_start();

    if (empty($_SESSION['login'])) {
        header("Location:index.php");
        exit();
    }

    include 'koneksi.php';

    $data_agency = array(); // Deklarasi awal untuk menghindari masalah "Undefined variable"

    if (isset($_GET['id_daftar'])) {
        $id_daftar = $_GET['id_daftar'];
        $_SESSION['id_daftar'] = $id_daftar;
        if (strpos($id_daftar, 'CBM-PMI-') === 0) {
            $sql = "SELECT a.id, a.username
            FROM likes l
            JOIN agensi a ON l.agensi_id = a.id
            WHERE l.id_daftar = ?";

            $stmt5 = $koneksi->prepare($sql);
            if (!$stmt5) {
                die('Error in preparing the SQL statement: ' . $koneksi->error);
            }

            $stmt5->bind_param("s", $id_daftar);

            $result5 = $stmt5->execute();
            if (!$result5) {
                die('Error in executing the SQL statement: ' . $stmt5->error);
            }

            $result5 = $stmt5->get_result();

            // Memasukkan data ke dalam array
            while ($row = $result5->fetch_assoc()) {
                $data_agency[] = array(
                    'id_agency' => $row['id'],
                    'nama_agency' => $row['username']
                );
            }

            $stmt5->close();
        } else {
            echo "ID Daftar tidak valid.";
        }
    }
    ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include "navbar2.php"; ?>
        <section class="content">
            <div class="container">
                <h2>Data Agency</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Agency</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_agency as $agency) : ?>
                        <tr>
                            <td><?php echo $agency['nama_agency']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>

</html>