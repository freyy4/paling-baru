<!DOCTYPE html>
<html>

<head>
    <title>Aplikasi Pengaduan Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/Screenshot__3_-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pengaduan Online</h5>
                <form action="https://primasyifanusantara.co.id/proses2.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nik">Nomor Induk Kependudukan:</label>
                        <input type="number" class="form-control" id="nik" name="nik" required oninput="maxLengthCheck(this)">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="hp">Nomor HP yang masih aktif:</label>
                        <input type="number" class="form-control" id="hp" name="hp" required>
                    </div>
                    <div class="form-group">
                        <label for="hubungan">Hubungan dengan PMI:</label>
                        <select class="form-control" id="hubungan" name="hubungan" required>
                            <option value="suami">Suami</option>
                            <option value="istri">Istri</option>
                            <option value="anak">Anak</option>
                            <option value="adik Kandung">Adik Kandung</option>
                            <option value="kakak kandung">Kakak Kandung</option>
                            <option value="ibu">Ibu</option>
                            <option value="bapak">Bapak</option>
                            <option value="kakek">Kakek</option>
                            <option value="nenek">Nenek</option>
                            <option value="PMI yang mengadu">PMI yang mengadu</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="permasalahan">Permasalahan:</label>
                        <textarea class="form-control" id="permasalahan" name="permasalahan" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Upload Foto:</label>
                        <input type="file" class="form-control-file" id="foto" name="foto" required>
                    </div>
                    <div class="form-group">
                        <label for="nik">Nomor Induk Kependudukan PMI:</label>
                        <input type="number" class="form-control" id="nik_pmi" name="nik_pmi" required oninput="maxLengthCheck(this)">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap dari PMI:</label>
                        <input type="text" class="form-control" id="nama_pmi" name="nama_pmi" required>
                    </div>
                    <div class="form-group">
                        <label for="permasalahan">Alamat PMI:</label>
                        <textarea class="form-control" id="alamat_pmi" name="alamat_pmi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nama">Tanggal Penerbangan PMI:</label>
                        <input type="date" class="form-control" id="tgl_terbang" name="tgl_terbang" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Negara Tujuan dari PMI:</label>
                        <input type="text" class="form-control" id="negara_tujuan" name="negara_tujuan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function maxLengthCheck(object) {
            if (object.value.length > 16) {
                object.value = object.value.slice(0, 16);
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const captchaImage = document.getElementById("captchaImage");
            const refreshButton = document.getElementById("refreshCaptcha");

            refreshButton.addEventListener("click", function() {
                // Generate a new timestamp to force image reload
                const timestamp = new Date().getTime();
                captchaImage.src = "captcha.php?" + timestamp;
            });
        });
    </script>
</body>

</html>