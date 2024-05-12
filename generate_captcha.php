<?php
session_start();

// Membuat CAPTCHA acak
$captcha = rand(1000, 9999);

// Menyimpan CAPTCHA di sesi
$_SESSION["captcha"] = $captcha;

// Membuat gambar CAPTCHA
$gambar = imagecreate(100, 40);
$warnaLatar = imagecolorallocate($gambar, 0, 0, 0);
$warnaTeks = imagecolorallocate($gambar, 255, 255, 255);
imagettftext($gambar, 20, 0, 10, 30, $warnaTeks, './nimbulus.ttf', $captcha);

header('Content-type: image/png');
imagepng($gambar);
imagedestroy($gambar);
