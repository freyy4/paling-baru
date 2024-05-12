<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email']; // Adjust this based on your actual session variable name for email

    // Generate a random OTP
    $otp = rand(100000, 999999);

    // Save the OTP to the session for verification later
    $_SESSION['otp'] = $otp;

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
    $mail->addAddress($email); // Use the session variable directly

    $mail->isHTML(true);
    $mail->Subject = "Verifikasi Email";
    $mail->Body = "<p>Verifikasi Email dengan Kode OTP dibawah ini</p><br>
                    <h1 align=center>$otp</h1>
                    <br><br><br>
                    <p>Hormat Kami</p><br><br>
                    <b>PT. Prima Syifa Nusantara</b>";

    if (!$mail->send()) {
        ?>
        <script>
            alert("<?php echo "Gagal mengirim OTP. Silakan coba lagi." ?>");
            window.location.replace('profil.php'); // Redirect to profile page
        </script>
    <?php
    } else {
        ?>
        <script>
            alert("<?php echo "OTP berhasil dikirim ke email " . $email ?>");
            window.location.replace('otp_input.php'); // Redirect to the verification page
        </script>
<?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 15px;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        h2 {
            margin-bottom: 10px;
            color: #333;
        }

        p {
            color: #666;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
<body>
<div class="profile-container">
    <h2>Verifikasi Email</h2>

    <form method="post">
        <p>Kami akan mengirimkan OTP ke email Anda. Klik tombol di bawah untuk verifikasi:</p>
        <button type="submit" name="verify" class="btn btn-primary">Verifikasi</button>
    </form>
</div>
</body>

</html>
