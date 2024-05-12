<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Data Diri</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/@4.1.0-rc.0/dist/css/.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php include "navbar3.php"; ?>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data Diri</li>
        </ol>
    </nav>
    <div class="container" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
                <h3>Biodata Diri</h3>
                <form method="post" action="daftaraa.php" enctype="multipart/form-data" id="myForm">
                    <!-- Baris 1 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">Nomor Induk Kependudukan</label>
                                <input type="number" class="form-control" id="nik"
                                    placeholder="Masukkan Nomor Induk Kependudukan" name="nik"
                                    oninput="maxLengthCheck(this)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan E-mail"
                                    name="email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap"
                                    placeholder="Masukkan Nama Lengkap" name="nama_lengkap"
                                    value="<?php echo $_SESSION['nama']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select id="jk" name="jk" class="form-control">
                                    <option value="">Jenis Kelamin</option>
                                    <option value="Laki - laki">Laki - laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 3 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir"
                                    placeholder="Masukkan Tempat Lahir" name="tempat_lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                    placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                    </div>

                    <!-- Baris 4 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status Perkawinan</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="">Status Perkawinan</option>
                                    <option value="Belum Menikah">Belum Menikah</option>
                                    <option value="Sudah Menikah">Sudah Menikah</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tinggi">Tinggi Badan (cm)</label>
                                <input type="number" class="form-control" id="tinggi"
                                    placeholder="Masukkan Tinggi Badan" name="tinggi">
                            </div>
                        </div>
                    </div>

                    <!-- Baris 5 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="berat">Berat Badan (kg)</label>
                                <input type="number" class="form-control" id="berat" placeholder="Masukkan Berat Badan"
                                    name="berat">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select id="provinsi" name="provinsi" class="form-control" onclick="loadProvinsi()">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 6 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kota">Kabupaten/Kota</label>
                                <select id="kota" name="kota" class="form-control" onclick="kabka()">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control" onclick="kec()">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 7 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelurahan">Desa</label>
                                <select id="kelurahan" name="desa" class="form-control" onclick="loadKelurahan()">
                                    <option value="">Pilih Desa</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat_lengkap">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3"
                                    placeholder="Masukkan Alamat Lengkap Anda"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 8 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telepon">Nomor WhatsApp</label>
                                <input type="number" class="form-control" id="telepon"
                                    placeholder="Masukkan Telepon yang bisa dihubungi" name="telepon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_ktp">Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control" id="foto_ktp" name="foto_ktp"
                                    accept="image/*,application/pdf">
                            </div>
                        </div>
                    </div>
                    <!-- Baris 9 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selfie_ktp">Selfie Dengan KTP Asli</label>
                                <input type="file" class="form-control" id="selfie_ktp" name="selfie_ktp"
                                    accept="image/*,application/pdf">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pas">Pas Foto 3 x 4</label>
                                <input type="file" class="form-control" id="pas" name="pas"
                                    accept="image/*,application/pdf">
                            </div>
                        </div>
                    </div>

                    <!-- Baris 10 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto">Foto Keseluruhan Badan (Tanpa Hijab/Penutup Kepala)</label>
                                <input type="file" class="form-control" id="foto" name="foto"
                                    accept="image/*,application/pdf">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kk">Kartu Keluarga</label>
                                <input type="file" class="form-control" id="kk" name="kk"
                                    accept="image/*,application/pdf">
                            </div>
                        </div>
                    </div>

                    <!-- Baris 11 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nikah">Buku Nikah / Surat Keterangan Nikah (Opsional)</label>
                                <input type="file" class="form-control" id="nikah" name="nikah"
                                    accept="image/*,application/pdf">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cerai">Akte Cerai (Opsional)</label>
                                <input type="file" class="form-control" id="cerai" name="cerai"
                                    accept="image/*,application/pdf">
                            </div>
                        </div>
                    </div>

                    <!-- Baris 12 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lahir">Akte Kelahiran</label>
                                <input type="file" class="form-control" id="lahir" name="lahir"
                                    accept="image/*,application/pdf">
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        </div>
                    </div>

                    <!-- Baris 13 -->
                    <div class="row">
                        <div class="col-md-12">
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
                        </div>
                    </div>
                    <input type="hidden" name="sponsor" value="<?php echo $_SESSION['nama'] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="daftar"
                                id="submitButton">Lanjut</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@4.1.0-rc.0/dist/js/.min.js"></script>
        <script>
        function maxLengthCheck(object) {
            if (object.value.length > 16) {
                object.value = object.value.slice(0, 16);
            }
        }

        function yakin() {
            return alert("Apa Anda Yakin Ingin Keluar?");
        }

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
                        kabkaSelect.add(option);;
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
                    }
                }
            };
            xhr.send();
        }
        </script>
</body>
<?php
if (isset($_POST['daftar'])) {
    include "koneksi.php";
    $query_latest_id = "SELECT id_daftar FROM daftar ORDER BY id_daftar DESC LIMIT 1";
    $result_latest_id = mysqli_query($koneksi, $query_latest_id);

    $prefix = "CBM-PMI-";
    $next_number = 1;

    if (mysqli_num_rows($result_latest_id) > 0) {
        $latest_id = mysqli_fetch_assoc($result_latest_id)['id_daftar'];
        $latest_number = intval(substr($latest_id, strlen($prefix))); // Extract the numeric part
        $next_number = $latest_number + 1;
    }

    $id_daftar = $prefix . sprintf('%02d', $next_number);
    $nik = $_POST['nik'];
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $jk = $_POST['jk'];
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
    $jenis = $_POST['jenis'];
    $negara = $_POST['negara'];
    $foto_ktp = basename($_FILES['foto_ktp']['name']);
    $selfie_ktp = basename($_FILES['selfie_ktp']['name']);
    $pas = basename($_FILES['pas']['name']);
    $foto = basename($_FILES['foto']['name']);
    $kk = basename($_FILES['kk']['name']);
    $nikah = basename($_FILES['nikah']['name']);
    $cerai = basename($_FILES['cerai']['name']);
    $lahir = basename($_FILES['lahir']['name']);
    move_uploaded_file($_FILES['foto_ktp']['tmp_name'], __DIR__ . '/' . $foto_ktp);
    move_uploaded_file($_FILES['selfie_ktp']['tmp_name'], __DIR__ . '/' . $selfie_ktp);
    move_uploaded_file($_FILES['pas']['tmp_name'], __DIR__ . '/' . $pas);
    move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . '/' . $foto);
    move_uploaded_file($_FILES['kk']['tmp_name'], __DIR__ . '/' . $kk);
    move_uploaded_file($_FILES['nikah']['tmp_name'], __DIR__ . '/' . $nikah);
    move_uploaded_file($_FILES['cerai']['tmp_name'], __DIR__ . '/' . $cerai);
    move_uploaded_file($_FILES['lahir']['tmp_name'], __DIR__ . '/' . $lahir);
    $sponsor = $_POST['sponsor'];
    $insert = mysqli_query($koneksi, "INSERT INTO daftar 
    (id_daftar, nik, nama_lengkap, jk, tempat_lahir, tgl_lahir, status, tinggi, berat, id_provinsi, id_kota, id_kecamatan, id_desa, alamat_lengkap, foto, foto_ktp, selfie_ktp, pas, kk, akte_kelahiran, akte_cerai, buku_nikah, email, telepon, terima, aktif, pekerjaan, negara, sponsor) VALUES 
    ('$id_daftar', '$nik', '$nama_lengkap', '$jk', '$tempat_lahir', '$tgl_lahir', '$status', '$tinggi', '$berat', '$provinsi', '$kota', '$kecamatan', '$desa', '$alamat_lengkap', '$foto', '$foto_ktp', '$selfie_ktp', '$pas', '$kk', '$lahir', '$cerai', '$nikah', '$email', '$telepon', 'tolak', 'nonaktif', '$jenis', '$negara', '$sponsor');");
    $_SESSION['id_daftar'] = $id_daftar;
    if ($insert) {
        echo "<script>
        Swal.fire({
            title: 'Data berhasil disimpan',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = 'daftarbb.php';
            }
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Oops, Sepertinya ada masalah',
            icon: 'warning',
            confirmButtonText: 'Coba Lagi'
        });
        </script>";
        echo mysqli_error($koneksi);        
    }
}
?>

</html>