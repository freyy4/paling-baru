<?php
session_start();
include('koneksi.php');

if (isset($_POST["recover"])) {
    $email = mysqli_real_escape_string($koneksi, $_POST["email"]);

    $sql = mysqli_query($koneksi, "SELECT * FROM login WHERE email='$email'");
    $user = mysqli_fetch_assoc($sql);

    if (!$user) {
        echo "<script>alert('Maaf, Email tidak ditemukan.');</script>";
    } else {
        // Generate unique token
        $token = bin2hex(random_bytes(50));

        // Set token and expiry time in the database
        $updateTokenSql = "UPDATE login SET reset_token = '$token', token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id = " . $user['id'];

        if (mysqli_query($koneksi, $updateTokenSql)) {
            // Send reset link via email
            require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtpdm-ap-southeast-1.aliyun.com';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';

            $mail->Username = 'info@crystalbirumeuligo.com';
            $mail->Password = '444R3Km4l4n9BB';

            $mail->setFrom('info@crystalbirumeuligo.com', 'PT Crystal Biru Meuligo');
            $mail->addAddress($email);

            // HTML body
            $resetLink = "https://daftarpmi.crystalbirumeuligo.com/reset_password.php?token=$token";
            $mail->isHTML(true);
            $mail->Subject = "Pemulihan Password";
            $mail->Body = "<h3>Silakan untuk reset password Anda, Klik tautan dibawah ini</h3>
                <a href='$resetLink' align='center' class='btn btn-primary'>Reset Password</a>
                <br><br>
                <p>Hormat Kami</p><br><br>
                <b>PT. Crystal Biru Meuligo</b>";

            if ($mail->send()) {
                echo "<script>alert('Email berhasil dikirim, silakan cek email Anda untuk petunjuk reset password.');</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan. Silahkan coba lagi nanti.');</script>";
            }
        } else {
            echo "<script>alert('Terjadi kesalahan. Silahkan coba lagi nanti.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
    body {
        background: #373B44;
        background: -webkit-linear-gradient(190deg, #4286f4, #373B44);
        background: linear-gradient(190deg, #4286f4, #373B44);
        font-family: 'Raleway', sans-serif;
        color: white;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    input[type=email],
    input[type=password] {
        background-color: transparent;
    }

    input[type=number]::placeholder,
    input[type=password]::placeholder {
        color: white;
    }

    .card {
        background: rgba(255, 255, 255, 0.1) !important;
        border-radius: 20px !important;
    }

    #togglePassword {
        cursor: pointer;
    }

    .usaha {
        width: 60px;
        height: 60px;
    }

    p,
    label,
    a,
    .btn {
        color: white !important;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Lupa Password</div>
            <div class="card-body">
                <form method="POST" action="#">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="recover">Kirim Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>