<?php
include "koneksi.php";
session_start();

// Check if the 'id_sekolah' parameter is present in the POST data
if (isset($_POST['id_sekolah'])) {
    $id_sekolah = $_POST['id_sekolah'];
    $nama_sekolah = $_POST['nama_sekolah'];
    $tgl_masuk_sekolah = $_POST['tgl_masuk_sekolah'];
    $tgl_lulus_sekolah = $_POST['tgl_lulus_sekolah'];

    $updateQuery = "UPDATE sekolah SET 
                    nama_sekolah=?, 
                    tgl_masuk_sekolah=?, 
                    tgl_lulus_sekolah=?";

    // Check if a new file is uploaded
    if (!empty($_FILES['ijazah_sekolah']['name'])) {
        $targetsekolah = "sekolah/";
        $ijazah_sekolah = $targetsekolah . basename($_FILES['ijazah_sekolah']['name']);

        // Move the uploaded file
        if (move_uploaded_file($_FILES['ijazah_sekolah']['tmp_name'], $ijazah_sekolah)) {
            $updateQuery .= ", ijazah_sekolah=?";
        } else {
            // Print an error message and halt the execution if file upload fails
            die("Error moving uploaded file.");
        }
    }

    $updateQuery .= " WHERE id=?";

    // Prepare the statement
    $stmt = mysqli_prepare($koneksi, $updateQuery);

    if ($stmt) {
        // Bind parameters
        if (!empty($_FILES['ijazah_sekolah']['name'])) {
            mysqli_stmt_bind_param($stmt, "sssi", $nama_sekolah, $tgl_masuk_sekolah, $tgl_lulus_sekolah, $ijazah_sekolah, $id_sekolah);
        } else {
            mysqli_stmt_bind_param($stmt, "ssi", $nama_sekolah, $tgl_masuk_sekolah, $tgl_lulus_sekolah, $id_sekolah);
        }

        // Execute the statement
        $update = mysqli_stmt_execute($stmt);

        if ($update) {
            echo "<script>
                    alert('Data sekolah berhasil diupdate');
                    window.location = 'dash.php';
                </script>";
        } else {
            // Print an error message if the update fails
            echo "<script>
                    alert('Gagal mengupdate data sekolah');
                    window.location = 'edit_sekolah.php?id=$id_sekolah';
                </script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Print an error message if the statement preparation fails
        echo "Error preparing statement: " . mysqli_error($koneksi);
    }
} else {
    // Redirect to dash.php if the form is not submitted properly
    header("Location: dash.php");
    exit();
}
?>
