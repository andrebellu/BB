<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Room</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../style.css">

</head>

<style>
    html,
    body {
        height: 100%;
        background-color: white;
    }

    .title {
        font-family: 'Philosopher', sans-serif;
    }
</style>

<body>
    <div class="navbar flex justify-between title text-black bg-gray-200 rounded-b-xl drop-shadow">
        <div class="px-4">
            <a class="text-2xl title hover:text-slate-500 transition-all duration-300" href="/BB">Swan B&B</a>
        </div>
        <div class="nav-links">
            <div class="tabs">
                <a class="tab tab-bordered title text-xl" href="./pages/about.html">About</a>

                <a class="tab tab-bordered title text-xl" href="../pages/login.php">Profile</a>
            </div>
        </div>
    </div>

    <div class="p-4">
        <h1 class="text-3xl text-black">Book a Room</h1>

        <form action="book.php" method="post" class="flex flex-col">
            <?php
            $hostname = 'mariadb';
            $dbname = 'BB';
            $user = 'root';
            $password = 'pippo';

            $conn = mysqli_connect($hostname, $user, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $id = $_COOKIE['id'];

            $q = "SELECT * FROM Clienti WHERE Codice = $id";

            $result = mysqli_query($conn, $q);

            echo '<label for="room">Room</label>
        <select name="room" id="room" required class="input placeholder-white text-white">';
            $hostname = 'mariadb';
            $dbname = 'BB';
            $user = 'root';
            $password = 'pippo';

            $conn = mysqli_connect($hostname, $user, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $q = "SELECT * FROM Camere";

            $result = mysqli_query($conn, $q);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Numero'] . "'>" . $row['Descrizione'] . "</option>";
                }
            }
            ?>
            </select>

            <label for="checkin">Check-in</label>
            <input class="input placeholder-white text-white" type="date" name="checkin" id="checkin" required>

            <label for="checkout">Check-out</label>
            <input type="date" name="checkout" id="checkout" class="input placeholder-white text-white" required>

            <label for="document">Document</label>
            <select name="document" id="document" required class="input placeholder-white text-white">
                <option value="ID">ID</option>
                <option value="Passport">Passport</option>
                <option value="Driving License">Driving License</option>
            </select>

            <input type="submit" class="btn text-black hover:text-white mt-10" value="Book">

        </form>

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $iduser = $_COOKIE['id'];
            $room = $_POST['room'];
            $checkin = $_POST['checkin'];
            $checkout = $_POST['checkout'];
            $document = $_POST['document'];

            $q = "INSERT INTO Prenotazioni (Cliente, Camera, DataArrivo, DataPartenza, Disdetta) VALUES ($id, $room, '$checkin', '$checkout', false)";

            $result = mysqli_query($conn, $q);

            if ($result) {
                echo "<p>Booking successful</p>";
            } else {
                echo "<p>Booking failed</p>";
            }
        }
        ?>
    </div>

</body>

</html>