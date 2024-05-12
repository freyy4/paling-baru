<?php include "head.php"; ?>
<?php 
    session_start();
    $id_daftar = $_SESSION['id_daftar'];
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include "navbar.php"; ?>
        <?php include "sidebar.php"; ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <ol>
                                <h5>Interview</h5>
                                <li>
                                    <form action="pertanyaan.php" method="post">
                                        <input type="hidden" name="id_daftar" id="id_daftar"
                                            value="<?php echo $id_daftar ?>">
                                        <fieldset>
                                            <label>Apakah Anda merokok?</label> <br>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="merokok"
                                                    id="ya_merokok" value="ya">
                                                <label class="form-check-label" for="ya_merokok">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="merokok"
                                                    id="tidak_merokok" value="tidak">
                                                <label class="form-check-label" for="tidak_merokok">Tidak</label>
                                            </div>
                                        </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Apakah Anda memiliki tato?</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tato" id="ya_tato"
                                                value="ya">
                                            <label class="form-check-label" for="ya_tato">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tato" id="tidak_tato"
                                                value="tidak">
                                            <label class="form-check-label" for="tidak_tato">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Apakah Anda memiliki alergi?</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="alergi" id="ya_alergi"
                                                value="ya">
                                            <label class="form-check-label" for="ya_alergi">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="alergi" id="tidak_alergi"
                                                value="tidak">
                                            <label class="form-check-label" for="tidak_alergi">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Apakah Anda punya penyakit keras?</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sakit_keras"
                                                id="ya_penyakit_keras" value="ya">
                                            <label class="form-check-label" for="ya_penyakit_keras">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sakit_keras"
                                                id="tidak_penyakit_keras" value="tidak">
                                            <label class="form-check-label" for="tidak_penyakit_keras">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Mengapa Anda ingin ke luar negeri?</label> <br>
                                        <textarea name="alasan_luar_negeri" id="alasan_luar_negeri"
                                            class="form-control"></textarea>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Apakah Anda Pernah minum Minuman keras?</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daging_babi"
                                                id="ya_memegang_daging_babi" value="ya">
                                            <label class="form-check-label" for="ya_memegang_daging_babi">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daging_babi"
                                                id="tidak_memegang_daging_babi" value="tidak">
                                            <label class="form-check-label"
                                                for="tidak_memegang_daging_babi">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Keterampilan yang dimiliki</label> <br>
                                        <select name="keterampilan" id="keterampilan" class="form-control">
                                            <option value=""></option>
                                            <option value="Baut">Baut</option>
                                            <option value="Pengecoran">Pengecoran</option>
                                            <option value="Pemotongan">Pemotongan</option>
                                            <option value="Solder">Solder</option>
                                            <option value="Las Mesin">Las Mesin</option>
                                            <option value="Mekanik Mesin">Mekanik Mesin</option>
                                            <option value="Mobil Truk Besar">Mobil Truk Besar</option>
                                            <option value="Ganti Cetakan">Ganti Cetakan</option>
                                            <option value="Rakit Mesin">Rakit Mesin</option>
                                            <option value="Forklift">Forklift</option>
                                            <option value="Platting/Pelapisan">Platting/Pelapisan</option>
                                            <option value="Pengecoran Logam">Pengecoran Logam</option>
                                            <option value="Penempaan">Penempaan</option>
                                            <option value="Driver">Driver</option>
                                            <option value="Penyemprotan Cat">Penyemprotan Cat</option>
                                            <option value="Konstruksi">Konstruksi</option>
                                            <option value="Tekstil">Tekstil</option>
                                            <option value="Hydrolic Press">Hydrolic Press</option>
                                            <option value="Bubut Manual">Bubut Manual</option>
                                            <option value="Komputer">Komputer</option>
                                            <option value="Eskavator/Penggali">Eskavator/Penggali</option>
                                            <option value="Mobil Derek Gantung">Mobil Derek Gantung</option>
                                            <option value="Grinding">Grinding</option>
                                            <option value="Mesin Bubut CNC">Mesin Bubut CNC</option>
                                            <option value="Nelayan">Nelayan</option>
                                            <option value="Air dan Listrik">Air dan Listrik</option>
                                            <option value="Petani">Petani</option>
                                            <option value="Packing">Packing</option>
                                        </select>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Apakah Anda punya Mata Minus/Plus/Slinder?</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="mata" id="ya_mata"
                                                value="ya">
                                            <label class="form-check-label" for="ya_mata">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="mata" id="tidak_mata"
                                                value="tidak">
                                            <label class="form-check-label" for="tidak_mata">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Apakah Anda Buta Huruf?</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="buta_huruf"
                                                id="ya_buta_huruf" value="ya">
                                            <label class="form-check-label" for="ya_buta_huruf">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="buta_huruf"
                                                id="tidak_buta_huruf" value="tidak">
                                            <label class="form-check-label" for="tidak_buta_huruf">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Apakah Anda Buta Warna?</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="buta_warna"
                                                id="ya_buta_warna" value="ya">
                                            <label class="form-check-label" for="ya_buta_warna">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="buta_warna"
                                                id="tidak_buta_warna" value="tidak">
                                            <label class="form-check-label" for="tidak_buta_warna">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Apakah Anda bersedia untuk tidak merokok?</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tidak_merokok"
                                                id="ya_tidak_merokok" value="ya">
                                            <label class="form-check-label" for="ya_tidak_merokok">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tidak_merokok"
                                                id="tidak_tidak_merokok" value="tidak">
                                            <label class="form-check-label" for="tidak_tidak_merokok">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Apakah Anda bersedia untuk lembur?</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lembur" id="ya_lembur"
                                                value="ya">
                                            <label class="form-check-label" for="ya_lembur">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lembur" id="tidak_lembur"
                                                value="tidak">
                                            <label class="form-check-label" for="tidak_lembur">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li>
                                    <fieldset>
                                        <label>Apakah Anda takut Ketinggian?</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ketinggian"
                                                id="ya_takut_ketinggian" value="ya">
                                            <label class="form-check-label" for="ya_takut_ketinggian">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ketinggian"
                                                id="tidak_takut_ketinggian" value="tidak">
                                            <label class="form-check-label" for="tidak_takut_ketinggian">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ol>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
<?php include "foot.php"; ?>

</html>

<?php
    include "koneksi.php";
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_daftar = $_POST['id_daftar'];
        $merokok = clean_input($_POST['merokok']);
        $tato = clean_input($_POST['tato']);
        $saudara_luar_negeri = clean_input($_POST['saudara_luar_negeri']);
        $alergi = clean_input($_POST['alergi']);
        $sakit_keras = clean_input($_POST['sakit_keras']);
        $alasan_luar_negeri = clean_input($_POST['alasan_luar_negeri']);
        $daging_babi = clean_input($_POST['daging_babi']);
        $keterampilan = clean_input($_POST['keterampilan']);
        $mata = clean_input($_POST['mata']);
        $buta_huruf = clean_input($_POST['buta_huruf']);
        $buta_warna = clean_input($_POST['buta_warna']);
        $tidak_merokok = clean_input($_POST['tidak_merokok']);
        $lembur = clean_input($_POST['lembur']);
        $ketinggian = clean_input($_POST['ketinggian']);

        // Melanjutkan memasukkan data ke dalam tabel
        $sql = "INSERT INTO interview (id_daftar, pertanyaan, jawaban) VALUES 
                ('$id_daftar', 'Apakah Anda merokok?', '$merokok'), 
                ('$id_daftar', 'Apakah Anda memiliki tato?', '$tato'), 
                ('$id_daftar', 'Apakah Anda punya Alergi?', '$alergi'), 
                ('$id_daftar', 'Apakah Anda punya penyakit keras?', '$sakit_keras'), 
                ('$id_daftar', 'Mengapa Anda ingin ke Luar negeri?', '$alasan_luar_negeri'), 
                ('$id_daftar', 'Apakah Anda meminum minuman keras?', '$daging_babi'), 
                ('$id_daftar', 'Keterampilan yang dimiliki', '$keterampilan'),
                ('$id_daftar', 'Apakah Anda punya Mata Minus/Plus/Slinder?', '$mata'),
                ('$id_daftar', 'Apakah Anda Buta Huruf?', '$buta_huruf'),
                ('$id_daftar', 'Apakah Anda Buta Warna?', '$buta_warna'),
                ('$id_daftar', 'Apakah Anda bersedia untuk tidak merokok?', '$tidak_merokok'),
                ('$id_daftar', 'Apakah Anda bersedia untuk lembur?', '$lembur'),
                ('$id_daftar', 'Apakah Anda takut Ketinggian?', '$ketinggian')";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script>
                window.location = 'dash.php'
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }
    
    // Tutup koneksi
    $koneksi->close();
?>