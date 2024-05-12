<?php
include 'koneksi.php';

function sendWhatsAppMessage($nowa, $pesan)
{
    $curl = curl_init();

    $dataSending = array(
        "api_key" => "VLEHPESTOYDX4GKW",
        "number_key" => "NV7JDP4tjchTa67Y",
        "phone_no" => $nowa,
        "message" => $pesan,
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

    // Tambahkan log atau notifikasi jika diperlukan
    if (!$error) {
        echo "<script>alert('Pesan WhatsApp terkirim.')</script>";
    } else {
        echo "<script>alert('Gagal mengirim pesan WhatsApp')</script>";
    }
}

$sql = "SELECT * FROM login WHERE id_daftar IS NULL";
$result = mysqli_query($koneksi, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nowa = $row['nowa']; // Nomor WhatsApp dari tabel login
            $namaLengkap = $row['nama']; // Nama lengkap dari tabel login
            $pesan = "Halo kak $namaLengkap, Kamu belum terdaftar nih, kalau mau daftar, silahkan klik disini ya kak\nhttps://daftarpmi.crystalbirumeuligo.com \n*Terimakasih* ";
            sendWhatsAppMessage($nowa, $pesan);
        }
    } else {
        echo '<script>alert("Semua pengguna sudah terdaftar.")</script>';
    }
} else {
    echo '<script>alert("Terjadi kesalahan dalam mengambil data.")</script>';
}

mysqli_close($koneksi);
?>