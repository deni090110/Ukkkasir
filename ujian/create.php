<?
include("koneksi.php");

if(isset($_POST['daftar'])){
    $username = $_POST['username'];
    $pasword = $_POST['pasword'];
     mysqli_query($db, "INSERT INTO user VALUES(NULL, '$username','$pasword')");
    header("Location: update.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <form method="post">
        <h1>buat akun mu</h1>
        <div>
            <label>username:</label>
            <input type="text" username="username" required>
        </div>
        <div>
            <label>pasword:</label>
            <input type="text" name="pasword" required>
        </div>
         <button type="submit" name="daftar" href="update.php">daftar</button>
    </form>
    
</body>
</html>