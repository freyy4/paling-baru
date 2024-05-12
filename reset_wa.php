<?php
session_start();
include('koneksi.php');

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($koneksi, $_GET['token']);
    $sql = mysqli_query($koneksi, "SELECT * FROM login WHERE reset_token='$token' AND token_expiry > NOW()");
    $user = mysqli_fetch_assoc($sql);
    if ($user) {
        if (isset($_POST['reset_password'])) {
            $newPassword = mysqli_real_escape_string($koneksi, $_POST['password']);
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updatePasswordSql = "UPDATE login SET password = '$hashedPassword', reset_token = NULL, token_expiry = NULL WHERE id = " . $user['id'];

            if (mysqli_query($koneksi, $updatePasswordSql)) {
                echo "<script>alert('Password berhasil direset. Silakan login dengan password baru.'); window.location.replace('index.php');</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan. Silakan coba lagi nanti.');</script>";
            }
        }
    } else {
        echo "<script>alert('Link reset password tidak valid atau telah kadaluarsa.'); window.location.replace('reset_password.php');</script>";
    }
} else {
    header('Location: reset_password.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">
                        <form method="POST" action="#">
                            <div class="form-group">
                                <label for="password">Password Baru:</label>
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Masukkan Password" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <img src="https://cdn.icon-icons.com/icons2/3361/PNG/512/optical_vision_views_visible_eye_password_show_password_visibility_view_eye_icon_210818.png" height="30px" width="30px" id="togglePassword">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="reset_password">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const credentialInput = document.getElementById('typeCredential');

    toggle.addEventListener('click', function() {
        if (password.type === "password") {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
</script>