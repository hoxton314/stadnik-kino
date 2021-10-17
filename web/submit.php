<?php
session_start();
if (!isset($_SESSION['logged']) or (isset($_SESSION['logged']) and $_SESSION['logged'] == false)) {
        $_SESSION["logged"] = false;
        echo "<script> window.location.replace('index.php')</script>";
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kino";

if (isset($_POST['seats']) and isset($_POST['movie'])) {
        foreach ($_POST['seats'] as &$seat) {
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                }



                $movie = $_POST['movie'];
                $user = $_SESSION["username"];
                $sql = "INSERT INTO seats (title,login,seat)
                VALUES ('$movie', '$user', '$seat')";





                if ($conn->query($sql) === TRUE) {
                        echo  "Reservation created successfully";
                        echo "<script> window.location.replace('kino.php')</script>";
                } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
        }
}
