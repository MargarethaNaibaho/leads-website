<!-- Membuat session baru -->
 <?php
 session_start();
 error_reporting(0);
 include 'connection/connection.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <script type="text/javascript" src="js/fontawesome.js"></script>
</head>
<body>
    <!-- Halaman Login -->
    <img src="img/wave.png" alt="" class="wave">
    <div class="container">
        <div class="img">
            <img src="img/img.svg" alt="">
        </div>
        <div class="login-container">
            <form action="" method="post">
                <img src="img/avatar.svg" alt="" class="avatar">
                <h2>Halo pegawai!</h2>

                <br>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h5>Email</h5>
                        <input type="email" name="email" class="input" required>
                    </div>
                </div>

                <div class="input-div two">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input type="password" name="password" class="input" required>
                    </div>
                </div>

                <br> 
                <input type="submit" name="login" class="btn" value="login">

            </form>
        </div>
    </div>
 
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>

<?php
    // Cek login
    if(isset($_POST["login"])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = hash('sha256', $password);

        $prepared_statement = $connection->prepare("SELECT * FROM m_user WHERE email = ? AND password = ?");
        $prepared_statement->bind_param("ss", $email, $hashed_password);
        $prepared_statement->execute();
        $result = $prepared_statement->get_result();

        if($result->num_rows > 0){
            $account = $result->fetch_assoc();
            $_SESSION['admin'] = $account;
            $_SESSION['id_user'] = $account['id_user'];
            
            echo "<script>alert('Anda Sukses Login');</script>";
		    echo "<script>location='home.php';</script>";
        } else {
            echo "<script>alert('Anda Gagal Login. Periksa Akun Anda');</script>";
        }

        $prepared_statement->close();
    }
?>