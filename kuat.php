<?php
// Fungsi untuk memeriksa kriteria keamanan password
function checkPasswordStrength($password) {
    $errors = [];

    echo "Panjang password harus ";

    if (strlen($password) < 8) {
        $errors[] = "minimal 8 karakter";
    }

    // Pemeriksaan keberadaan huruf besar, huruf kecil, dan angka
    if (!preg_match('/[A-Z]+/', $password)) {
        $errors[] = "satu huruf besar";
    }
    if (!preg_match('/[a-z]+/', $password)) {
        $errors[] = "satu huruf kecil";
    }
    if (!preg_match('/[0-9]+/', $password)) {
        $errors[] = "satu angka";
    }

    // Pemeriksaan keberadaan simbol
    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
        $errors[] = "satu simbol.";
    }

    // Jika tidak ada kesalahan, password memenuhi kriteria
    if (empty($errors)) {
        return "Password telah memenuhi kriteria keamanan.";
    } else {
        return implode(", ", $errors);
    }
}

// Ambil password yang dikirimkan melalui AJAX
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    echo checkPasswordStrength($password);
}
?>
