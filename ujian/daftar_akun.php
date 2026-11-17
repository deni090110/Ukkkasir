<?php
session_start();
include("koneksi.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

$data_user = mysqli_query($db, "SELECT id, username, role FROM user");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Admin & Petugas</title>
<link rel="stylesheet" href="style.css?v=<?= time(); ?>"></head>
</head>
<body>

    <div class="navbar">
        <div class="brand">INVENTORI APP | <?= htmlspecialchars($_SESSION['username']); ?> (<?= ucfirst($_SESSION['role']); ?>)</div>
        <div class="menu">
            <a href="dashboard.php">Data Produk</a>
            <a href="tambah_stok.php">Tambah Stok</a>
            <a href="create.php">Register Person</a>
            <a href="daftar_akun.php" class="active">Data List Admin</a>
            <a href="logout.php" class="logout" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>Daftar Admin & Petugas</h2>
        <table>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aktivitas</th>
            </tr>
            <?php 
            $no = 1;
            while ($u = mysqli_fetch_assoc($data_user)) { 
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($u['username']); ?></td>
                <td><?= ucfirst(htmlspecialchars($u['role'])); ?></td>
                <td>
                    <a href="edit.php?id=<?= $u['id']; ?>" class="btn btn-edit">Edit</a>
                    <form method="post" action="delete.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $u['id']; ?>">
                        <button type="submit" name="hapus" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus akun ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>