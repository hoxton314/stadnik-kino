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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kino</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#movie-list').change(function() {
                let movie = $(this).val();
                let movId;
                let movTitle;
                for (let i = 0; i < $('.movie-info').length; i++) {
                    let objID = "#" + $('.movie-info')[i].id
                    //console.log($('.movie-info')[i])
                    if ($('.movie-info')[i].id == movie.replace(/ +/g, "-")) {
                        $(objID).css('display', '')
                        movTitle = $('.movie-info')[i].id
                        movId = $(objID)[0].children[1]
                    } else {
                        $(objID).css('display', 'none')
                    }
                }

                displaySeats()
            });


            //console.log($('.movie-info'))
            let selectMovie = $('#movie-list').val().replace(/ +/g, "-")
            let movId;
            let movTitle;
            for (let i = 0; i < $('.movie-info').length; i++) {
                let objID = "#" + $('.movie-info')[i].id
                //console.log($('.movie-info')[i])
                if ($('.movie-info')[i].id == selectMovie) {
                    $(objID).css('display', '')
                    movTitle = $('.movie-info')[i].id
                    movId = $(objID)[0].children[1]
                } else {
                    $(objID).css('display', 'none')
                }
            }

            displaySeats()


            function displaySeats() {
                $('#seats').empty()
                let selectMovie = $('#movie-list').val()
                let seatsData = $('#seats-php').text().split(";")
                seatsData.pop()
                seatsData[0] = seatsData[0].replace("\n", "").slice(8)
                seatsData = seatsData.filter(a => a.split(',')[1] == selectMovie)
                console.log(seatsData)
                //id="seats"
                for (let y = 0; y < 15; y++) {
                    for (let x = 0; x < 20; x++) {
                        let seat = $('<div>')
                        seat.attr("id", y + "-" + x)
                        seat.attr("class", "seat")
                        seat.css('left', x * 25 + 'px')
                        seat.css('top', y * 25 + 'px')
                        seat.css('backgroundColor', seatsData.some(a => a.split(',')[3] == y + "-" + x) ? 'red' : 'green')
                        $('#seats').append(seat)
                    }
                }

                $('.seat').on('click', (e) => {
                let s = '#' + e.target.id
                console.log($(s).css('backgroundColor'))
                if ($(s).css('backgroundColor') == 'rgb(0, 128, 0)') {
                    $(s).css('backgroundColor', 'orange')
                } else if ($(s).css('backgroundColor') == 'rgb(255, 165, 0)') {
                    $(s).css('backgroundColor', 'green')
                }
            })
            }

            function sendReservReq(e) {
                console.log($('.seat'))
                let reserv = []
                for (let i = 0; i < 300; i++) {
                    let id = $('.seat')[i].id
                    if ($('#' + id).css('backgroundColor') == 'rgb(255, 165, 0)') {
                        reserv.push(id)
                        console.log(id)
                    }
                }

                $.ajax({
                    url: 'submit.php',
                    type: 'POST',
                    data: {
                        seats: reserv,
                        movie: $('#movie-list').val()
                    },
                    success: function(data) {
                        console.log(data); // Inspect this in your console
                    }
                })

                async function refresh(){
                    await new Promise(r => setTimeout(r, 2000))
                    window.location.replace('kino.php')
                }
                refresh()

            }
            $('#insertseats').on('click', sendReservReq)
        })
    </script>
</head>

<body>
    Kino, jesteś zalogowany
    <a href="logout.php" tite="Logout">Wyloguj.</a>




    <div>
        <form>
            <select class="movie-list" id="movie-list" name="movies" onchange="">

                <?php
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, title, poster, description FROM movies";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        //echo $row["login"] . " " . $_POST['username'] . " " . $row["password"] . " " . hash("md5", $_POST['password']) . "<br>";
                        $movies[] = [$row["title"], $row["id"], $row["poster"], $row["description"]];
                        echo  '<option value="' . $row["title"] . '">' . $row["title"] . '</option>';
                    }
                }


                ?>

            </select>
        </form>


        <?php
        foreach ($movies as &$obj) {
            echo '<div class="movie-info" id="' . str_replace(' ', '-', $obj[0]) . '" ><div class="movie-title">' . $obj[0] . ' </div><div class="movie-id"> ' . $obj[1] . ' </div><div class="movie-img"> <img src="' . $obj[2] . '"> </img> </div><div class="movie-description"> ' . $obj[3] . ' </div></div>';
        }
        ?>


    </div>
    <button id="insertseats">Zarezerwuj</button>
    <div id="seats">

    </div>




    <div class="php-data" id="seats-php">
        <?php
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, title, login, seat FROM seats";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo $row["id"] . ',' . $row["title"] . ',' . $row["login"] . ',' . $row["seat"] . ';';
            }
        }
        ?>
    </div>
</body>

</html>