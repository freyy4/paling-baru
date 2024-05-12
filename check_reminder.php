<?php
include "koneksi.php"; 

// Fungsi untuk mengirim notifikasi WhatsApp
function kirimNotifikasiWhatsApp($nomor, $pesan) {
    $curl = curl_init();
    $dataSending = array(
        "api_key" => "VLEHPESTOYDX4GKW",
        "number_key" => "NV7JDP4tjchTa67Y",
        "phone_no" => $nomor, // Menggunakan parameter $nomor yang diteruskan
        "message" => $pesan // Menggunakan parameter $pesan yang diteruskan
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

    curl_close($curl);
    echo $response;
}

// Fungsi untuk memeriksa dan mengirim notifikasi
function cekDanKirimNotifikasi() {
    global $koneksi;

    $batas_waktu_upload_sekarang = date('Y-m-d H:i:s');
    $query = "SELECT * FROM daftar WHERE batas_waktu_upload < '$batas_waktu_upload_sekarang' AND terima = 'tolak' AND notifikasi_whatsapp = 'belum'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nomor_whatsapp = $row['telepon'];
            $pesan_notifikasi = "Halo, Anda belum mengunggah file-file yang diperlukan. Silakan segera lengkapi pendaftaran Anda.";
            
            // Panggil fungsi untuk mengirim notifikasi WhatsApp
            kirimNotifikasiWhatsApp($nomor_whatsapp, $pesan_notifikasi);

            // Tandai bahwa notifikasi telah dikirim (misalnya, dengan mengubah status di database)
            $id_daftar = $row['id_daftar'];
            mysqli_query($koneksi, "UPDATE daftar SET notifikasi_whatsapp = 'sudah' WHERE id_daftar = '$id_daftar'");
        }
    }
}

// Panggil fungsi untuk memeriksa dan mengirim notifikasi saat file check_reminder.php diakses
cekDanKirimNotifikasi();
?>
