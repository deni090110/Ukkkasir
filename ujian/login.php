<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <header>
            <h1 class="rr">SILAKAN MASUKKAN USERNAME DAN PASSWORD</h1>
        </header>

        <form action="halmin.php" method="post">
                <p> 
                    <label for="usn">username:</label>
                    <input type="text" id="usn" name="username" placeholder="Masukkan username mu">
                </p>
<br>
                <p>
                    <label for="pw">pasword:</label>
                    <input type="pasword" id="pw" name="pasword" placeholder="Masukkan password mu">
                </p>
<br>
                <p>
                    <button type="submit">LOGIN</button>
                </p>
        </form>

    </div>
</body>
</html>