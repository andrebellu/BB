<?php
// check if cookie is set or if it is empty
if (!isset($_COOKIE['id']) || empty($_COOKIE['id'])) {
    header("Location: ../pages/login.php");
}
?>


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
                <a class="tab tab-bordered title text-xl" href="../pages/about.html">About</a>

                <a class="tab tab-bordered title text-xl" href="../pages/login.php">Profile</a>
            </div>
        </div>
    </div>

    <div class="bookings flex p-10 flex-col">

        <div class="btns pb-4">
            <a class="btn text-xl" href="../pages/book.php">Book</a>
            <a class="btn text-xl" href="../php/logout.php">Logout</a>
        </div>

        <h1 class="text-2xl pb-2">Le tue prenotazioni</h1>

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

        $stay =

            $result = mysqli_query($conn, $q);

        if ($result->num_rows > 0) {
            echo "<table class='min-w-full divide-y divide-gray-200'><thead class='bg-gray-50'><tr>";
            echo "<th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Confirmed?</th>";
            echo "<th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Camera</th>";
            echo "<th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Check-in</th>";
            echo "<th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Check-out</th>";
            echo "<th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Confirm Booking</th>";
            echo "<th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Delete</th>";
            echo "<th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Modify</th>";
            echo "</tr></thead>";

            while ($row = $result->fetch_assoc()) {
                $q = "SELECT * FROM Soggiorni WHERE Prenotazione = " . $row["id"];
                $result2 = mysqli_query($conn, $q);

                if ($result2->num_rows > 0) {
                    echo "<tr class='border-b'><td class='px-6 py-3'>✔</td>";
                } else {
                    echo "<tr class='border-b'><td class='px-6 py-3'>❌</td>";
                }

                echo "<td class='px-6 py-3'>" . $row["Camera"] . "</td><td class='px-6 py-3'>" . $row["DataArrivo"] . "</td><td class='px-6 py-3'>" . $row["DataPartenza"] . "</td><td class='px-6 py-3'><a href='confirm.php?id=" . $row["id"] . "'>Confirm</a></td><td class='px-6 py-3'><a href='delete.php?id=" . $row["id"] . "'>Delete</a></td><td class='px-6 py-3'><a href='edituserbook.php?id=" . $row["id"] . "'>Modify</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        ?>
    </div>

</body>

</html>