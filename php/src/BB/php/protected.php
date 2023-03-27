<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

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

    <div class="navbar flex justify-between title text-black z-20">
        <div class="px-4">
            <a class="text-2xl title hover:text-slate-500 transition-all duration-300" href="/BB">Swan B&B</a>
        </div>
        <div class="nav-links">
            <div class="tabs">
                <a class="tab tab-bordered title text-xl" href="./pages/about.html">About</a>
                <a class="tab tab-bordered title text-xl" href="./php/book.php">Book</a>
                <a class="tab tab-bordered title text-xl" href="../pages/login.html">Profile</a>
            </div>
        </div>
    </div>

    <div class="bookings flex">
        <?php
        $id = $_COOKIE['id'];

        $hostname = 'mariadb';
        $dbname = 'BB';
        $server = 'localhost';
        $username = 'root';
        $password = 'pippo';

        $conn = mysqli_connect($hostname, $username, $password, $dbname);

        if ($conn->connect_errno) {
            die("Connection failed: " . mysqli_connect_error());
        }
        ;

        $q = "SELECT * FROM Prenotazioni WHERE Cliente = $id";

        $result = mysqli_query($conn, $q);

        if ($result->num_rows > 0) {
            echo "<h1>Le tue prenotazioni</h1>";
            echo "<table><tr><th>Cliente</th><th>Camera</th><th>Check-in</th><th>Check-out</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Cliente"] . "</td><td>" . $row["Camera"] . "</td><td>" . $row["DataArrivo"] . "</td><td>" . $row["DataPartenza"] . "</td><td>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }


        ?>
    </div>

    <a class="btn btn-primary title text-xl" href="../pages/book.php">Book</a>

</body>

</html>