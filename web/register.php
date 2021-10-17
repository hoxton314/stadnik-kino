<?php
session_start();
if (!isset($_SESSION['logged'])) {
    $_SESSION["logged"] = false;
}
if (isset($_SESSION['logged']) and $_SESSION['logged']) {
    echo "<script> window.location.replace('kino.php')</script>";
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kino";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
</head>

<body>
    <div class="container form-signin">
        <?php
        $msg = '';
        if (
            isset($_POST['register']) && !empty($_POST['username'])
            && !empty($_POST['password'])
        ) {


            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            //$_POST['username']
            $nick = $_POST['username'];
            $phone = $_POST['phone'];
            $pass = hash("md5", $_POST['password']);
            $sql = "INSERT INTO users (login, phone, password)
            VALUES ('$nick', '$phone', '$pass')";


            if ($conn->query($sql) === TRUE) {
                echo "New account created successfully";
                echo "<script> window.location.replace('login.php')</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
    </div>

    <div class="container">
        <form class="form-signin" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
                                                        ?>" method="post">
            <h4 class="form-signin-heading"><?php echo $msg; ?></h4>
            <input type="text" class="form-control" name="username" placeholder="2137" required autofocus></br>
            <input type="text" class="form-control" name="phone" placeholder="123456789" required autofocus></br>
            <input type="password" class="form-control" name="password" placeholder="2137" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register</button>
        </form>
    </div>
</body>

</html>