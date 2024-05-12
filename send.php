<?php
require __DIR__ . '/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = 'user'; // Di sini bisa diatur sesuai kebutuhan, misal 'admin' untuk pesan dari admin
    $message = $_POST['message'];
    
    $data = array('role' => $role, 'message' => $message);
    $pusher->trigger('chat', 'message', $data);
}
?>
