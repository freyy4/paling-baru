<?php
session_start();
include('koneksi.php');

if (isset($_POST["recover"])) {
    $nowa = mysqli_real_escape_string($koneksi, $_POST["nowa"]);

    $sql = mysqli_query($koneksi, "SELECT * FROM login WHERE nowa='$nowa'");
    $user = mysqli_fetch_assoc($sql);

    if (!$user) {
        echo "Maaf, Nomor WhatsApp tidak ditemukan.";
    } else {
        // Generate unique token
        $token = bin2hex(random_bytes(50));

        // Set token and expiry time in the database
        $updateTokenSql = "UPDATE login SET reset_token = '$token', token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id = " . $user['id'];

        if (mysqli_query($koneksi, $updateTokenSql)) {
            // Send WhatsApp message
            $curl = curl_init();
            $dataSending = array(
                "api_key" => "VLEHPESTOYDX4GKW",
                "number_key" => "NV7JDP4tjchTa67Y",
                "phone_no" => $nowa,
                "message" => "Halo, Selamat Datang di WhatsApp Resmi PT. Crystal Biru Meuligo, Klik disini untuk Lupa Password: https://daftarpmi.crystalbirumeuligo.com/reset_wa.php?token=$token"
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
            $error = curl_error($curl);

            curl_close($curl);

            if (!$error) {
                echo "<script>alert('Silakan cek Nomor WhatsApp Anda untuk petunjuk reset password.');</script>";
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

    input[type=number],
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
    <div class="container">
        <div class="card">
            <div class="card-header">Lupa Password</div>
            <div class="card-body">
                <form method="POST" action="#">
                    <div class="form-group">
                        <label for="nowa">Nomor WhatsApp:</label>
                        <input type="number" class="form-control" id="nowa" name="nowa" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="recover">Kirim Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>