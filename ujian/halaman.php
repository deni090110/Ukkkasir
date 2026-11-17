<?php
session_start();
include("koneksi.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
    header("Location: login.php");
    exit();
}

$data = mysqli_query($db, "SELECT id, username, role FROM user");
if (!$data) {
    die("Query gagal: " . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Petugas</title>
</head>
<body>

    <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?> (Petugas)</h1>
    <a href="logout.php" onclick="return confirm('Yakin ingin keluar?')">Logout</a>

    <p>Daftar akun yang terdaftar di sistem:</p>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= htmlspecialchars($user['id']); ?></td>
            <td><?= htmlspecialchars($user['username']); ?></td>
            <td><?= htmlspecialchars($user['role']); ?></td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>