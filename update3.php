<?php
if (isset($_GET['id_daftar'])) {
    include 'koneksi.php';
    $id_daftar = mysqli_real_escape_string($koneksi, $_GET['id_daftar']);
    $update = "UPDATE daftar SET terima='tolak', aktif='nonaktif'  WHERE id_daftar='$id_daftar'";
    if (mysqli_query($koneksi, $update)) {
        $result = mysqli_query($koneksi, "SELECT telepon FROM daftar WHERE id_daftar = '$id_daftar'");
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $nowa = $row['telepon']; 
            $pesan = "Maaf, permohonan Anda telah ditolak. Terima kasih.";
            $dataSending = array(
                "api_key" => "VLEHPESTOYDX4GKW",
                "number_key" => "NV7JDP4tjchTa67Y",
                "phone_no" => $nowa,
                "message" => $pesan,
            );
            $curl = curl_init();
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
            if ($error) {
                echo "Error: $error";
            } else {
                echo "<script>alert('Pesan penolakan telah dikirim ke WhatsApp');
                window.location.href = 'admin/admin.php';
                </script>";
            }
        } else {
            echo "Nomor telepon tidak ditemukan atau terdapat lebih dari satu entri dengan id_daftar yang sama.";
        }
    } else {
        echo "Terjadi kesalahan dalam memperbarui data: " . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
} else {
    echo "Tidak ada parameter id_daftar yang diterima.";
}
?>