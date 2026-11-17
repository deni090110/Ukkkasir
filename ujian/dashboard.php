<?php
session_start();
include("koneksi.php");

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['hapus_produk']) && $_SESSION['role'] === 'admin') {
    $id_produk = $_POST['id'];
    $stmt = $db->prepare("DELETE FROM produk WHERE id = ?");
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
    exit();
}

$data_produk = mysqli_query($db, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk - Dashboard</title>
<link rel="stylesheet" href="style.css?v=<?= time(); ?>"></head>
<body>

    <div class="navbar">
        <div class="brand">INVENTORI APP | <?= htmlspecialchars($_SESSION['username']); ?> (<?= ucfirst($_SESSION['role']); ?>)</div>
        <div class="menu">
            <a href="dashboard.php" class="active">Data Produk</a>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="tambah_stok.php">Tambah Stok</a>
                <a href="daftar.php">Register Person</a>
                <a href="daftar_akun.php">Data List Admin</a>
            <?php endif; ?>
            <a href="logout.php" class="logout" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>Daftar Produk & Stok</h2>
        <table>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <th>Aktivitas</th>
                <?php endif; ?>
            </tr>
            <?php 
            $no = 1;
            while ($brg = mysqli_fetch_assoc($data_produk)) { 
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($brg['nama_barang']); ?></td>
                <td>Rp <?= number_format($brg['harga'], 0, ',', '.'); ?></td>
                <td><?= $brg['stok']; ?></td>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <td>
                        <form method="post" action="dashboard.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $brg['id']; ?>">
                            <button type="submit" name="hapus_produk" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>