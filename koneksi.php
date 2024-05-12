<?php
$koneksi = mysqli_connect("sql3.crystalbirumeuligo.com", "root", "@r3km4l4n9", "pjtki", 3306);

if (mysqli_connect_errno()) {
	echo "Koneksi database gagal : " . mysqli_connect_error();
}