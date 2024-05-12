<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Time Password PT. Crystal Biru Meuligo | Pendaftaran Online</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
    /* Gaya baru untuk input OTP */
    .otp-input {
        width: 50px;
        /* Lebar input */
        height: 50px;
        /* Tinggi input */
        text-align: center;
        /* Teks ditengah */
        font-size: 1.5em;
        /* Ukuran font */
        margin-right: 0.5em;
        /* Ruang antar input */
        border: 2px solid #ced4da;
        /* Border input */
        border-radius: 0.25em;
        /* Sudut input */
        outline: none;
        /* Hilangkan outline saat aktif */
    }

    /* Gaya untuk input OTP saat aktif */
    .otp-input:focus {
        border-color: #007bff;
        /* Warna border saat aktif */
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        /* Efek bayangan saat aktif */
    }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var otpInputs = document.querySelectorAll('.otp-input');
        for (var i = 0; i < otpInputs.length; i++) {
            otpInputs[i].addEventListener('input', function() {
                if (this.value.length === this.maxLength) {
                    var index = Array.prototype.indexOf.call(otpInputs, this);
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                }
            });
        }
    });
    </script>
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow" style="border-radius: 1rem;">
                    <div class="card-body">
                        <form class="mb-md-5 mt-md-4 pb-5" action="#" method="POST">
                            <div class="form-outline">
                                <label class="text-danger">Masukkan kode OTP yang kami kirimkan ke Nomor WhatsApp
                                    Anda</label>
                                <input type="text" class="form-control" name="otp_code" required autofocus>
                            </div>
                            <input type="submit" class="btn btn-success" value="Verifikasi" name="verify">
                        </form>
                        <div class="text-center">
                            <p>Tidak menerima OTP?</p>
                            <form action="#" method="POST">
                                <input type="submit" class="btn btn-danger btn-sm" value="Kirim Ulang Kode OTP"
                                    name="resend">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include('koneksi.php');

if (isset($_POST["verify"])) {
    $otp = $_SESSION['otp'];
    $nowa = $_SESSION['nowa'];
    $nama = $_SESSION['nama'];
    $otp_code = $_POST['otp_code'];

    if ($otp != $otp_code) {
        ?>
<script>
alert("Kode OTP tidak cocok dengan yang kami kirimkan ke Nomor WhatsApp. Silakan coba lagi.");
</script>
<?php
    } else {
        // Update status login jika verifikasi berhasil
        mysqli_query($koneksi, "UPDATE login SET status = 1 WHERE nowa = '$nowa'");
        ?>
<script>
alert("Verifikasi berhasil. Silahkan login dengan Nomor WhatsApp Anda.");
</script>
<?php
$curl = curl_init();
$dataSending = array(
    "api_key" => "VLEHPESTOYDX4GKW",
    "number_key" => "NV7JDP4tjchTa67Y",
    "phone_no" => $nowa,
    "message" => "Selamat ya kak *$nama* tinggal selangkah lagi buat daftar☺️, \n\nKalo bingung cara daftarnya bisa klik link ini ya \n\n *https://ptcbm.id/2024/02/19/crystal-biru-meuligo-membuka-pendaftaran-online-bagi-pmi-gini-caranya/* \n\n *🔖Catatan* \nJika Anda memiliki Keluhan, Anda dapat ke https://chat.crystalbirumeuligo.com/register untuk Chat Admin ya☺️ \n\n_Ini adalah pesan satu arah. Jangan membalas pesan ini_ \n\n _Bot Otomatis_ "
);
curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dataSending),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
    ),
));
$response = curl_exec($curl);
curl_close($curl);
?>
<script>
window.location.replace("index.php");
</script>
<?php
    }
}

if (isset($_POST["resend"])) {
    $nowa = $_SESSION['nowa'];
    $nama = $_SESSION['nama'];
    $otp = rand(100000, 999999);

    $curl = curl_init();
    $dataSending = array(
        "api_key" => "VLEHPESTOYDX4GKW",
        "number_key" => "NV7JDP4tjchTa67Y",
        "phone_no" => $nowa,
        "message" => "Kode Verifikasi Anda adalah *$otp*, kode berlaku selama *30 menit*. Jangan beritau kode ini kepada siapapun."
    );
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dataSending),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    // Simpan ulang waktu kedaluwarsa dalam sesi
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_expire'] = date("Y-m-d H:i:s", strtotime("+30 minutes")); // Misalnya, ulang kirim setelah 5 menit
    ?>
<script>
alert("Kode OTP telah berhasil dikirim ulang ke Nomor WhatsApp Anda.");
</script>
<?php
}
?>