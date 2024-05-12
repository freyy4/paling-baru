<?php
session_start();

// Buat string captcha acak
$captcha = generateRandomString(5); // Panjang captcha 5 karakter

// Simpan string captcha dalam session
$_SESSION['captcha'] = $captcha;

// Buat gambar captcha
$image = imagecreatetruecolor(120, 40); // Lebar 120 dan tinggi 40

// Warna latar belakang putih
$bgColor = imagecolorallocate($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);

// Fungsi untuk menghasilkan warna acak
function randomColor($image) {
    return imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
}

// Fungsi untuk menghasilkan posisi teks acak
function randomPosition() {
    return mt_rand(5, 15);
}

// Tambahkan teks captcha ke gambar dengan warna dan posisi acak
$textColor = randomColor($image);
imagestring($image, 5, randomPosition(), randomPosition(), $captcha, $textColor); // Ukuran teks 5

// Set header untuk output gambar
header('Content-type: image/png');

// Tampilkan gambar captcha
imagepng($image);

// Hapus gambar dari memori
imagedestroy($image);

// Fungsi untuk menghasilkan string acak (huruf dan angka)
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charLength - 1)];
    }
    return $randomString;
}
?>
