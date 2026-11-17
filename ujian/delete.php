<?php
session_start();
include('koneksi.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $db->prepare("DELETE FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: update.php?pesan=sukses_hapus");
        exit();
    } else {
        echo "Gagal menghapus data: " . $db->error;
    }
    
    $stmt->close();
} else {
    header("Location: update.php");
    exit();
}

$db->close();
?>