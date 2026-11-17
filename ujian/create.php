<?php
include("koneksi.php");

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password = $_POST['pasword']; 

    $stmt = $db->prepare("INSERT INTO user (username, pasword) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: update.php");
        exit;
    } else {
        echo "Pendaftaran gagal: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>

<body>

    <form method="post">
        <h1>Buat Akunmu</h1>

        <div>
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>

        <div>
            <label>Password:</label>
            <input type="password" name="pasword" required>
        </div>

        <button type="submit" name="daftar">Daftar</button>
    </form>

</body>
</html>