<?php
if (isset($_GET['file'])) {
    $file_to_delete = urldecode($_GET['file']);
    if (file_exists($file_to_delete)) {
        if (unlink($file_to_delete)) {
            header("Location: admin2/index.php");
            exit;
        } else {
            echo "Gagal menghapus file $file_to_delete.";
        }
    } else {
        echo "File $file_to_delete tidak ditemukan.";
    }
} else {
    echo "Parameter 'file' tidak ditemukan.";
}
?>
<?php require_once("foot.php"); ?>