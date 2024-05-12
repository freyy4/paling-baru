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
    include 'koneksi.php';
    session_start();
    $id_daftar = $_SESSION['id_daftar'];
    $sql = "SELECT * FROM daftar WHERE id_daftar = '$id_daftar'";
    $data = mysqli_query($koneksi, $sql);
    while ($d = mysqli_fetch_array($data)) {
    ?>
    <div class="container card">
        <h5>Update Data dengan Nama "<?php echo $d['nama_lengkap']; ?>"</h5>
        <form action="edit.php" method="post">
            <input type="hidden" name="id_daftar" value="<?php echo $d['id_daftar']; ?>">
            <div class="form-group">
                <label for="nik">Nomor Induk Kependudukan *</label>
                <input type="number" class="form-control" id="nik" placeholder="Masukkan Nomor Induk Kependudukan"
                    name="nik" required value="<?php echo $d['nik']; ?>">
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap *</label>
                <input type="text" class="form-control" id="nama_lengkap" placeholder="Masukkan Nama Lengkap"
                    name="nama_lengkap" required value="<?php echo $d['nama_lengkap']; ?>">
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Tempat Lahir *</label>
                <input type="text" class="form-control" id="tempat_lahir" placeholder="Masukkan Tempat Lahir"
                    name="tempat_lahir" required value="<?php echo $d['tempat_lahir']; ?>">
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Tanggal Lahir *</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required
                    value="<?php echo $d['tgl_lahir']; ?>">
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Status Perkawinan *</label>
                <select id="status" name="status" class="form-control" required value="<?php echo $d['status']; ?>">
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Sudah Menikah">Sudah Menikah</option>
                    <option value="Cerai Hidup">Cerai Hidup</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nik">Tinggi Badan *</label>
                <input type="number" class="form-control-sm" id="tinggi" placeholder="Masukkan Tinggi Badan"
                    name="tinggi" required value="<?php echo $d['tinggi']; ?>"> cm
            </div>
            <div class="form-group">
                <label for="nik">Berat Badan *</label>
                <input type="number" class="form-control-sm" id="berat" placeholder="Masukkan Berat Badan" name="berat"
                    required value="<?php echo $d['berat']; ?>"> kg
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi *</label>
                <select id="provinsi" name="provinsi" class="form-control" onclick="loadProvinsi()" required
                    value="<?php echo $d['provinsi']; ?>">
                    <option value="">Pilih Provinsi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kota">Kabupaten/Kota *</label>
                <select id="kota" name="kota" class="form-control" onclick="kabka()" required
                    value="<?php echo $d['kota']; ?>">
                    <option value="">Pilih Kabupaten/Kota</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kecamatan">Kecamatan *</label>
                <select id="kecamatan" name="kecamatan" class="form-control" onclick="kec()" required
                    value="<?php echo $d['kecamatan']; ?>">
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kelurahan">Desa *</label>
                <select id="kelurahan" name="desa" class="form-control" onclick="loadKelurahan()" required
                    value="<?php echo $d['desa']; ?>">
                    <option value="">Pilih Desa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat_lengkap">Alamat Lengkap *</label>
                <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3"
                    placeholder="Masukkan Alamat Lengkap Anda" required
                    value="<?php echo $d['alamat_lengkap']; ?>"></textarea>
            </div>
            <div class="form-group">
                <label for="telepon">Nomor Telepon *</label>
                <input type="number" class="form-control" id="telepon"
                    placeholder="Masukkan Telepon yang bisa dihubungi" name="telepon" required
                    value="<?php echo $d['telepon']; ?>">
            </div>
            <div class="form-group">
                <label for="jenis">Keahlian Utama</label>
                <select id="jenis" name="jenis" class="form-control">
                    <option value="">Pilih Keahlian Utama</option>
                    <option value="Perawat Orang Tua">Perawat Orang Tua</option>
                    <option value="Panti Jompo">Panti Jompo</option>
                    <option value="Konstruksi">Konstruksi</option>
                    <option value="Manufaktur">Manufaktur</option>
                    <option value="Housemaid">Housemaid</option>
                    <option value="Baby Sitter">Baby Sitter</option>
                    <option value="Welder">Welder</option>
                    <option value="Filter">Filter</option>
                </select>
            </div>
            <div class="form-group">
                <label for="negara">Negara Tujuan</label>
                <select id="negara" name="negara" class="form-control">
                    <option value="">Pilih Negara</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Singapura">Singapura</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Korea Selatan">Korea Selatan</option>
                    <option value="Jepang">Jepang</option>
                </select>
            </div>
            <input type="submit" value="Update" class="btn btn-primary form-control" name="update">
        </form>
        <?php } ?>
    </div>

    <?php
        if (isset($_POST['update'])) {
            $id_daftar = $_POST['id_daftar'];
            $nik = $_POST['nik'];
            $nama_lengkap = $_POST['nama_lengkap'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $tgl_lahir = $_POST["tgl_lahir"];
            $status = $_POST['status'];
            $tinggi = $_POST['tinggi'];
            $berat = $_POST['berat'];
            $provinsi = $_POST['provinsi'];
            $kota = $_POST['kota'];
            $kecamatan = $_POST['kecamatan'];
            $desa = $_POST['desa'];
            $alamat_lengkap = $_POST['alamat_lengkap'];
            $telepon = $_POST['telepon'];

            include "koneksi.php";
            $update = mysqli_query($koneksi, "UPDATE daftar SET nik = '$nik', nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', status = '$status', tinggi = '$tinggi', berat = '$berat', id_provinsi = '$provinsi', id_kota = '$kota', id_kecamatan = '$kecamatan', id_desa = '$desa', alamat_lengkap = '$alamat_lengkap', telepon = '$telepon' WHERE id_daftar = '$id_daftar';");

            if ($update) {
                echo "<script>
        alert('Data berhasil diperbarui 😁');
        window.location='dash3.php';
        </script>";
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
        }
        ?>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    const form = document.getElementById('myForm');
    const submitButton = document.getElementById('submitButton');

    form.addEventListener('input', function() {
        if (isFormComplete()) {
            submitButton.removeAttribute('disabled');
        } else {
            submitButton.setAttribute('disabled', 'disabled');
        }
    });

    function isFormComplete() {
        const inputs = form.querySelectorAll('input[required]');
        for (const input of inputs) {
            if (!input.value.trim()) {
                return false;
            }
        }
        return true;
    }
    </script>

    <script>
    $(document).ready(function() {
        $("#provinsi").select2({
            data: loadProvinsi(),
            placeholder: "Pilih Provinsi Anda"
        });
    });

    function yakin() {
        return alert("Apa Anda Yakin Ingin Keluar?");
    }
    </script>
    <script>
    function loadProvinsi() {
        let xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            'json/provinces.json'
        );

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let provinsi = JSON.parse(xhr.responseText);
                let provinsiSelect = document.getElementById("provinsi");
                for (let i = 0; i < provinsi.length; i++) {
                    let option = document.createElement("option");
                    option.value = provinsi[i].id;
                    option.text = provinsi[i].nama;
                    provinsiSelect.add(option);
                }
            }
        };
        xhr.send();
    }

    function kabka() {
        let xhr = new XMLHttpRequest();
        let provinsiId = document.getElementById("provinsi").value;
        xhr.open(
            "GET", `json/kabupaten/${provinsiId}.json`
        );

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let kabka = JSON.parse(xhr.responseText);
                let kabkaSelect = document.getElementById("kota");
                for (let i = 0; i < kabka.length; i++) {
                    let option = document.createElement("option");
                    option.value = kabka[i].id;
                    option.text = kabka[i].nama;
                    kabkaSelect.add(option);
                    $("#kota").select2({
                        placeholder: "Pilih Kabupaten/Kota Anda"
                    });
                }
            }
        };
        xhr.send();
    }

    function kec() {
        let xhr = new XMLHttpRequest();
        let kabupatenId = document.getElementById("kota").value; // Menggunakan ID kabupaten yang dipilih
        xhr.open(
            "GET", `json/kecamatan/${kabupatenId}.json` // Ganti dengan path ke file JSON kecamatan
        );

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let kecamatan = JSON.parse(xhr.responseText);
                let kecamatanSelect = document.getElementById("kecamatan");
                for (let i = 0; i < kecamatan.length; i++) {
                    let option = document.createElement("option");
                    option.value = kecamatan[i].id;
                    option.text = kecamatan[i].nama;
                    kecamatanSelect.add(option);
                    $("#kecamatan").select2({
                        placeholder: "Pilih Kecamatan Anda"
                    });
                }
            }
        };
        xhr.send();
    }

    function loadKelurahan() {
        let xhr = new XMLHttpRequest();
        let kecamatanId = document.getElementById("kecamatan").value; // Menggunakan ID kecamatan yang dipilih
        xhr.open(
            "GET", `json/kelurahan/${kecamatanId}.json` // Ganti dengan path ke file JSON desa
        );

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let kelurahanData = JSON.parse(xhr.responseText);
                let kelurahanSelect = document.getElementById("kelurahan");
                for (let i = 0; i < kelurahanData.length; i++) {
                    let option = document.createElement("option");
                    option.value = kelurahanData[i].id;
                    option.text = kelurahanData[i].nama;
                    kelurahanSelect.add(option);
                    $("#kelurahan").select2({
                        placeholder: "Pilih Desa/Kelurahan Anda"
                    });
                }
            }
        };
        xhr.send();
    }
    </script>
</body>

</html>