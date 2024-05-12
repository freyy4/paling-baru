<?php
session_start();
include('koneksi.php');

// Fungsi untuk memverifikasi reCAPTCHA
function verifyRecaptcha($recaptcha_response) {
    $recaptcha_secret_key = '6LfMl3MpAAAAAP1PswLVrgxlkHVqKjNPE-BQWrlz'; // Ganti dengan kunci rahasia reCAPTCHA Anda
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_data = array(
        'secret' => $recaptcha_secret_key,
        'response' => $recaptcha_response
    );
    $recaptcha_options = array(
        'http' => array(
            'method' => 'POST',
            'content' => http_build_query($recaptcha_data)
        )
    );
    $recaptcha_context = stream_context_create($recaptcha_options);
    $recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
    $recaptcha_response_json = json_decode($recaptcha_result);
    return $recaptcha_response_json->success;
}

if (isset($_POST["register"])) {
    $nowa = $_POST["nowa"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $nama = $_POST["nama"];
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Verifikasi reCAPTCHA
    if (verifyRecaptcha($recaptcha_response)) {
        // Validasi lainnya
        if (!empty($nowa) && !empty($password) && !empty($confirm_password) && !empty($nama)) {
            // Validasi apakah nomor WhatsApp sudah terdaftar
            $check_query = mysqli_query($koneksi, "SELECT * FROM login WHERE nowa ='$nowa' OR nama='$nama' AND status=1");
            $rowCount = mysqli_num_rows($check_query);

            if ($rowCount > 0) {
                // Nomor WhatsApp atau nama sudah terdaftar
                echo '<div class="alert alert-danger alert-dismissible fade show sticky-top" role="alert">
                        <strong>Oops...</strong> Nomor WhatsApp atau Nama sudah terdaftar.
                    </div>';
            } elseif ($password !== $confirm_password) {
                // Password dan konfirmasi password tidak cocok
                echo '<div class="alert alert-danger alert-dismissible fade show sticky-top" role="alert">
                        <strong>Oops...</strong> Password dan konfirmasi password tidak cocok.
                    </div>';
            } else {
                // Lanjutkan proses pendaftaran karena nomor WhatsApp atau nama belum terdaftar
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $user = "user";

                // Insert data pendaftaran ke database
                $result = mysqli_query($koneksi, "INSERT INTO login (nama, nowa, password, status, role) VALUES ('$nama', '$nowa', '$password_hash', 0, '$user')");

                if ($result) {
                        $otp = rand(100000, 999999);
                        $_SESSION['otp'] = $otp;
                        $_SESSION['nowa'] = $nowa;
                        $_SESSION['nama'] = $nama;
    
                        date_default_timezone_set('Asia/Jakarta');
                        $currentDateTime = date('Y-m-d H:i:s');
                        $otp_expire = date('Y-m-d H:i:s', strtotime($currentDateTime . ' +30 minutes'));
    
                        $update_otp_query = mysqli_query($koneksi, "UPDATE login SET otp_code = $otp, otp_expire = '$otp_expire' WHERE nowa = '$nowa'");
                        if (!$update_otp_query) {
                            echo '<div class="alert alert-danger alert-dismissible fade show sticky-top" role="alert">
                                <strong>Error!</strong> Terjadi kesalahan dalam proses pengiriman OTP
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        }
    
                        // Kirim pesan WhatsApp dengan OTP
                        $curl = curl_init();
                        $dataSending = array(
                            "api_key" => "VLEHPESTOYDX4GKW",
                            "number_key" => "NV7JDP4tjchTa67Y",
                            "phone_no" => $nowa,
                            "message" => "Kode Verifikasi Anda adalah *$otp*, kode berlaku selama *30 menit*. Jangan beritau kode ini kepada siapapun",
                            "buttons" => array(
                                            array(
                                                "type" => "url",
                                                "url" => "javascript:void(prompt('Salin Kode:', '$otp'))",
                                                "text" => "Salin Kode"
                                            )
                                        )
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

                    echo '<script>
                            alert("Registrasi berhasil. Silakan cek WhatsApp Anda untuk instruksi selanjutnya.");
                            window.location.replace("verification.php");
                        </script>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show sticky-top" role="alert">
                            <strong>Oops...</strong> Terjadi kesalahan saat mendaftarkan akun. Silakan coba lagi nanti.
                        </div>';
                }
            }
        } else {
            // Formulir tidak lengkap
            echo '<div class="alert alert-danger alert-dismissible fade show sticky-top" role="alert">
                    <strong>Oops...</strong> Mohon lengkapi semua kolom.
                </div>';
        }
    } else {
        // Validasi reCAPTCHA gagal
        echo '<div class="alert alert-danger alert-dismissible fade show sticky-top" role="alert">
                <strong>Oops...</strong> Validasi reCAPTCHA gagal. Silakan coba lagi.
            </div>';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="favicon.jpg" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    
    body {
        background-color: #193da5;
        background-repeat: no-repeat;
        background-size: cover;
        font-family: 'Raleway', sans-serif;
        color: white;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
    }

    #togglePassword {
        cursor: pointer;
    }

    p,
    label,
    a,
    .btn {
        color: white;
    }
    </style>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="icon" href="Favicon.png">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Registrasi DaftarPMI | Pendaftaran Online</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6">
                <div class="card-body">
                    <h4 class="text-white text-center">Registrasi</h4>
                    <form class="mb-md-5" action="register.php" method="POST" name="register">
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typeEmailX">Nama Lengkap</label>
                            <input type="text" id="nama" class="form-control" name="nama"
                                placeholder="Masukkan Nama Lengkap" required autofocus/>
                        </div>
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typeEmailX">Nomor WhatsApp</label>
                            <input type="number" id="nowa" class="form-control" name="nowa"
                                placeholder="Masukkan Nomor WhatsApp" required/>
                        </div>
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typePasswordX">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control"
                                    name="password" placeholder="Masukkan Password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <img src="https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_visible_hide_hidden_show_icon_145988.png"
                                            height="20px" width="20px" id="togglePassword">
                                    </div>
                                </div>
                            </div>
                            <p class="card-text" id="passwordCriteria"></p>
                        </div>
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                            <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Masukkan Password Sekali Lagi" required>
                        </div>
                        <label for="">Masukkan reCaptcha</label>
                        <div class="g-recaptcha" data-sitekey="6LfMl3MpAAAAAGhUFtX6vXD5yAowVq9EtigAI7CZ"></div>
                        <input type="submit" class="btn btn-outline-dark btn-md" value="Daftar Sekarang"
                            name="register">
                    </form>

                    <div>
                        <p class="mb-0">Sudah punya Akun? <a href="index.php" class="fw-bold" style="color: white;">Masuk
                                disini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
const toggle = document.getElementById('togglePassword');
const password = document.getElementById('password');

toggle.addEventListener('click', function() {
    if (password.type === "password") {
        password.type = 'text';
        toggle.src =
            'https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_slash_visible_hide_hidden_show_icon_145987.png';
    } else {
        password.type = 'password';
        toggle.src =
            'https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_visible_hide_hidden_show_icon_145988.png';
    }
});
</script>
</html>