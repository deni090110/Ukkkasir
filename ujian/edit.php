<?php
include("koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $db->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        header("Location: update.php");
        exit();
    }
    $stmt->close();
} else {
    header("Location: update.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $id_user  = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['pasword'];

    $stmt_update = $db->prepare("UPDATE user SET username = ?, pasword = ? WHERE id = ?");
    $stmt_update->bind_param("ssi", $username, $password, $id_user);

    if ($stmt_update->execute()) {
        header("Location: update.php?pesan=sukses_edit");
        exit();
    } else {
        echo "Gagal mengupdate data: " . $stmt_update->error;
    }

    $stmt_update->close();
}

$db->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
<link rel="stylesheet" href="style.css?v=<?= time(); ?>"></head>
<body>

    <div class="login-container">
        <header>
            <h1 class="rr">EDIT DATA USER</h1>
        </header>

        <form method="post" action="">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">

            <p>
                <label for="usn">Username:</label>
                <input type="text" id="usn" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
            </p>

            <p>
                <label for="pw">Password Baru:</label>
                <input type="text" id="pw" name="pasword" value="<?= htmlspecialchars($user['pasword']); ?>" required>
            </p>

            <p>
                <button type="submit" name="simpan">SIMPAN PERUBAHAN</button>
            </p>
            
        </form>
    </div>

</body>
</html>