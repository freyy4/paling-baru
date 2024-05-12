<!DOCTYPE html>
<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location:index.php");
}

// Simulate fetching user data from a database
$nama = $_SESSION['nama'];
$nowa = $_SESSION['nowa'];
$email = $_SESSION['email'];
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Pengguna</title>
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
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    h2 {
        margin-bottom: 10px;
        color: #333;
    }

    form {
        text-align: left;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    button {
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>

    <div class="profile-container">
        <h2>Edit Profil</h2>
        <form action="update_profile.php" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>

            <label for="nowa">Nomor WhatsApp:</label>
            <input type="text" id="nowa" name="nowa" value="<?php echo $nowa; ?>" readonly>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

            <button type="submit">Simpan Perubahan</button>
            <button type="button" onclick="coba()">Kembali</button>
        </form>
    </div>

</body>
<script>
function coba() {
    window.location = 'dash.php';
}
</script>

</html>