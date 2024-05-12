<?php
include "koneksi.php";
session_start();

if (!empty($_SESSION['login'])) {
    header("Location: dash.php");
    exit();
}

if (isset($_POST["login"])) {
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => '6LfMl3MpAAAAAP1PswLVrgxlkHVqKjNPE-BQWrlz', 
        'response' => $recaptcha_response
    );

    $options = array(
        'http' => array (
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success = json_decode($verify);

    if ($captcha_success->success == false) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops...</strong> Harap verifikasi captcha
            </div>';
    } else if ($captcha_success->success == true) {
        $credential = mysqli_real_escape_string($koneksi, trim($_POST['credential']));
        $password = trim($_POST['password']);

        $sql = mysqli_query($koneksi, "SELECT * FROM login WHERE nowa = '$credential' OR email = '$credential'");
        $count = mysqli_num_rows($sql);

        if ($count > 0) {
            $fetch = mysqli_fetch_array($sql);
            $hashpassword = $fetch["password"];

            if (password_verify($password, $hashpassword)) {
                $_SESSION['login'] = md5($fetch['nowa']);
                $_SESSION['id'] = $fetch['id'];
                $_SESSION['id_daftar'] = $fetch['id_daftar'];
                $_SESSION['nowa'] = $fetch['nowa']; 
                $_SESSION['nama'] = $fetch['nama'];
                $_SESSION['email'] = $fetch['email'];
                $_SESSION['email_verify'] = $fetch['email_verify'];
                $_SESSION['role'] = $fetch['role'];

                if ($fetch['role'] == 'user') {
                    if ($fetch['id_daftar'] != null) {
                        header("Location: dash.php");
                        exit();
                    } else {
                        header("Location: dash.php");
                        exit();
                    }
                } elseif ($fetch['role'] == 'admin2') {
                    header("Location: admin2/index.php");
                    exit();
                } elseif ($fetch['role'] == 'admin') {
                    header("Location: admin/dash.php");
                    exit();
                } elseif ($fetch['role'] == 'verifikator') {
                    header("Location: admin/dash.php");
                    exit();
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops...</strong> Nomor WhatsApp atau Email dan Password Anda Salah, Coba Lagi
                    </div>';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops...</strong> Nomor WhatsApp atau Email tidak ditemukan
                </div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="favicon.jpg" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <title>Login DaftarPMI | Pendaftaran Online</title>
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
</head>

<body>
    <div class="container">
        <div class="col-md-8">
            <div class="card-body">
                <h4 class="text-center">Login</h4>
                <form class="mb-md-5" action="index.php" method="POST" name="login">
                    <div class="form-group">
                        <label for="typeCredential">Nomor WhatsApp atau Email-mu</label>
                        <input type="text" id="typeCredential" class="form-control" name="credential"
                            placeholder="Nomor WhatsApp atau Email" required autofocus />
                    </div>
                    <div class="form-group">
                        <label for="typePasswordX">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="Masukkan Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <img src="https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_slash_visible_hide_hidden_show_icon_145987.png"
                                        height="20px" width="20px" id="togglePassword">
                                </div>
                            </div>
                        </div>
                    </div>
                    <label>Masukkan reCaptcha</label>
                    <div class="g-recaptcha" data-sitekey="6LfMl3MpAAAAAGhUFtX6vXD5yAowVq9EtigAI7CZ"></div>
                    <input type="submit" class="btn btn-success" value="Masuk" name="login"><br>
                    <b class="mt-3 mb-0">Belum punya Akun? <a href="register.php" class="text-black fw-bold"
                            style="color: white;">Registrasi disini</a></b><br>
                    <b class="mt-3 mb-0">Baca disini : <a
                            href="https://ptcbm.id/2024/02/19/crystal-biru-meuligo-membuka-pendaftaran-online-bagi-pmi-gini-carannya/"
                            class="text-white fw-bold" target="blank">Cara Daftar CPMI di Crystal Biru Meuligo via Online.</a></b><br><br>
                    <p>Lupa Password?, <a href="wa.php" class="btn btn-success btn-sm">Via WhatsApp</a> atau <a href="recover_psw.php" class="btn btn-danger btn-sm">Via Email</a></p><br>
            </div>
            </form><br>
            <p class="text-white text-center sticky-bottom" style="font-size:12px;">Copyright &copy; PT. Crystal Biru Meuligo
                | 2024</p>
        </div>
    </div>

    <script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function() {
        if (password.type === "password") {
            password.type = 'text';
            toggle.src =
                'https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_visible_hide_hidden_show_icon_145988.png';
        } else {
            password.type = 'password';
            toggle.src =
                'https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_slash_visible_hide_hidden_show_icon_145987.png';
        }
    });
    </script>
</body>

</html>