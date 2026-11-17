<?php
session_start();
include("koneksi.php");

$pesan_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['pasword']);

    if (empty($username) || empty($password)) {
        $pesan_error = "Username dan password tidak boleh kosong!";
    } else {
        $stmt = $db->prepare("SELECT id, username, pasword, role FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($password === $row['pasword']) {
                $_SESSION['id']       = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role']     = $row['role'];

                header("Location: dashboard.php");
                exit();
            } else {
                $pesan_error = "Password yang kamu masukkan salah!";
            }
        } else {
            $pesan_error = "Akun belum terdaftar!";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
<link rel="stylesheet" href="style.css?v=<?= time(); ?>"></head>
<body>
    <div class="login-container">
        <header>
            <h1 class="rr">SILAKAN MASUKKAN USERNAME DAN PASSWORD</h1>
        </header>

        <?php if (!empty($pesan_error)): ?>
            <div>
                <?= $pesan_error; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <p>
                <label for="usn">Username:</label>
                <input type="text" id="usn" name="username" placeholder="Masukkan username mu" required>
            </p>

            <p>
                <label for="pw">Password:</label>
                <input type="password" id="pw" name="pasword" placeholder="Masukkan password mu" required>
            </p>

            <p>
                <button type="submit">LOGIN</button>
            </p>
        </form>
    </div>
</body>
</html>