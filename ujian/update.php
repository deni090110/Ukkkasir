<?php
include("koneksi.php");

$data = mysqli_query($db, "SELECT * FROM user");

if (!$data) {
    die("Query gagal: " . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
<link rel="stylesheet" href="style.css?v=<?= time(); ?>"></head>
<body>


<table border="1" cellpadding="10">
    <tr>
        <th>ID</th> 
        <th>Username</th>
        <th>Password</th>
        <th>Aksi</th>
    </tr>

    <?php while ($user = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= htmlspecialchars($user['id']); ?></td>
        <td><?= htmlspecialchars($user['username']); ?></td>
        <td>********</td>
        <td>
            <button type="submit" name="edit" onclick="window.location.href='edit.php'">edit</button>
            <br>
            <form method="post" action="delete.php">
                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                <button type="submit" name="hapus" onclick="return confirm('Yakin ingin menghapus?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>