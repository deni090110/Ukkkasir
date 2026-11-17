<?php
session_start();
include("koneksi.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

$pesan = "";

if (isset($_POST['tambah_barang'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga       = (int)$_POST['harga'];
    $stok        = (int)$_POST['stok'];

    $stmt_brg = $db->prepare("INSERT INTO produk (nama_barang, harga, stok) VALUES (?, ?, ?)");
    $stmt_brg->bind_param("sii", $nama_barang, $harga, $stok);
    $stmt_brg->execute();
    $stmt_brg->close();

    $pesan = "Produk baru berhasil ditambahkan!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Stok Produk</title>
<link rel="stylesheet" href="style.css?v=<?= time(); ?>"></head>
</head>
<body>

    <div class="navbar">
        <div class="brand">INVENTORI APP | <?= htmlspecialchars($_SESSION['username']); ?> (<?= ucfirst($_SESSION['role']); ?>)</div>
        <div class="menu">
            <a href="dashboard.php">Data Produk</a>
            <a href="tambah_stok.php" class="active">Tambah Stok</a>
            <a href="create.php">Register Person</a>
            <a href="daftar_akun.php">Data List Admin</a>
            <a href="logout.php" class="logout" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>Tambah Produk Baru</h2>

        <?php if (!empty($pesan)): ?>
            <div class="alert"><?= $pesan; ?></div>
        <?php endif; ?>

        <form method="post" action="tambah_stok.php">
            <div class="form-group">
                <label>Nama Produk:</label>
                <input type="text" name="nama_barang" required>
            </div>
            <div class="form-group">
                <label>Harga (Rp):</label>
                <input type="number" name="harga" min="0" required>
            </div>
            <div class="form-group">
                <label>Stok Awal:</label>
                <input type="number" name="stok" min="0" required>
            </div>
            <button type="submit" name="tambah_barang" class="btn">Simpan Produk</button>
        </form>
    </div>

</body>
</html>