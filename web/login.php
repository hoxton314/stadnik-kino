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
    <title>Logowanie</title>
</head>

<body>
    <div class="container form-signin">
        <?php
        $msg = '';
        if (
            isset($_POST['login']) && !empty($_POST['username'])
            && !empty($_POST['password'])
        ) {

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, login, password FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    //echo $row["login"] . " " . $_POST['username'] . " " . $row["password"] . " " . hash("md5", $_POST['password']) . "<br>";
                    if (($row["login"] ==  $_POST['username']) and ($row["password"] == hash("md5", $_POST['password']))) {
                        $_SESSION["logged"] = true;
                        $_SESSION["userid"] = $row["id"];
                        $_SESSION["username"] = $row["login"];
                        echo 'You have entered valid use name and password';
                        echo "<script> window.location.replace('kino.php')</script>";
                    }
                }
                if ($_SESSION["logged"] == false) {
                    $msg = 'Wrong username or password';
                }
            } else {
                echo "connection error";
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
            <input type="password" class="form-control" name="password" placeholder="2137" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
        </form>
    </div>
</body>

</html>