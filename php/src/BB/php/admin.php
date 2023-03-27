<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>


    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

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

    <div class="navbar flex justify-between title text-black bg-gray-200 rounded-b-xl drop-shadow mb-10">
        <div class="px-4">
            <a class="text-2xl title hover:text-slate-500 transition-all duration-300" href="/BB">Swan B&B <br /> <span
                    class="text-sm leading-none">Admin
                    Dashboard</span></a>
        </div>
        <div class="nav-links">
            <p>Welcome, Admin</p>
        </div>
    </div>

    <div class="bookings flex">

        <?php
        $hostname = 'mariadb';
        $dbname = 'BB';
        $username = 'root';
        $password = 'pippo';

        $conn = mysqli_connect($hostname, $username, $password, $dbname);

        if ($conn->connect_errno) {
            die("Connection failed: " . mysqli_connect_error());
        }
        ;

        $clientsnumber = "SELECT COUNT(*) FROM Clienti";
        $bookingsnumber = "SELECT COUNT(*) FROM Prenotazioni WHERE Disdetta = 0";
        $bookingsnumbertotal = "SELECT COUNT(*) FROM Prenotazioni";
        $roomsnumber = "SELECT COUNT(*) FROM Camere";


        $clientsnumber = mysqli_query($conn, $clientsnumber);
        $bookingsnumberactive = mysqli_query($conn, $bookingsnumber);
        $roomsnumber = mysqli_query($conn, $roomsnumber);
        $bookingsnumbertotal = mysqli_query($conn, $bookingsnumbertotal);

        $clientsnumber = mysqli_fetch_array($clientsnumber)[0];
        $bookingsnumberactive = mysqli_fetch_array($bookingsnumberactive)[0];
        $roomsnumber = mysqli_fetch_array($roomsnumber)[0];
        $bookingsnumbertotal = mysqli_fetch_array($bookingsnumbertotal)[0];

        $perc = round(($bookingsnumberactive / $bookingsnumbertotal) * 100, 0);

        echo '

            <div
                class="mx-4 w-1/3 transform hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                <div class="p-5">
                    <div class="flex justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8">' . $clientsnumber . '</div>

                            <div class="mt-1 text-base text-gray-600">Clients</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-4 w-1/3 transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
        <div class="p-5">
            <div class="flex justify-between">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <div class="bg-blue-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                    <span class="flex items-center">' . $perc . '%</span>
                </div>
            </div>
            <div class="ml-2 w-full flex-1">
                <div>
                    <div class="mt-3 text-3xl font-bold leading-8">' . $bookingsnumberactive . '</div>

                    <div class="mt-1 text-base text-gray-600">Active Bookings</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-4 w-1/3 transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
        <div class="p-5">
            <div class="flex justify-between">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>
            </div>
            <div class="ml-2 w-full flex-1">
                <div>
                    <div class="mt-3 text-3xl font-bold leading-8">' . $roomsnumber . '</div>

                    <div class="mt-1 text-base text-gray-600">Rooms</div>
                </div>
            </div>
        </div>
    </div>
    

        </div>
        </div>';

        $id = $_COOKIE['id'];

        $q = "SELECT * FROM Clienti, Prenotazioni WHERE Clienti.Codice = Prenotazioni.Cliente";

        $result = mysqli_query($conn, $q);

        if ($result->num_rows > 0) {
            echo '<div class="px-4">';
            echo "<h1 Le class='text-3xl p-4 pt-8'>User's Bookings</h1>";
            echo '<table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Cliente</span>
                    </div>
                </th>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Nome</span>
                    </div>
                </th>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Camera</span>
                    </div>
                </th>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Check-in</span>
                    </div>
                </th>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Check-out</span>
                    </div>
                </th>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Disdetta</span>
                    </div>
                </th>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Azione</span>
                    </div>
                </th>
            </tr>
        </thead>';

            while ($row = $result->fetch_assoc()) {
                echo '<tbody class="bg-white divide-y divide-gray-200">
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                    <p>' . $row["Cliente"] . '</p>'
                    . '</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                    <p>' . $row["Nome"] . '</p>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                    <p>' . $row["Camera"] . '</p>'
                    . '</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                    <p>' . $row["DataArrivo"] . '</p>'
                    . '</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                    <p>' . $row["DataPartenza"] . '</p>'
                    . '</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5">';

                if ($row["Disdetta"] == false) {
                    echo "<p class='text-red-500'>No</p>";
                } else {
                    echo "<p class='text-green-500'>Si</p>";
                }
                ;
                echo '</p>' . '</td>' . '<td class="px-6 py-4">
            <div class="flex justify-start">
            <a href="disdetta.php?id=' . $row["id"] . ' "class="text-blue-500 hover:text-blue-600 pr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        <p>Cancel</p>
    </a>
    <a href="delete.php?id=' . $row["id"] . ' "class="text-red-500 hover:text-red-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 ml-3" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        <p class="text-center">Delete</p>
    </a>                 
    </div>
    </td>
    </tr>
    </tbody>';
            }
        } else {
            echo "0 results";
        }

        $q = "SELECT * FROM Soggiorni";

        $res = mysqli_query($conn, $q);

        if (mysqli_num_rows($res) > 0) {
            echo '<table class="divide-y divide-gray-200 w-full">
            <h1 class="text-3xl p-4 pt-8">Stays</h1>
        <thead>
            <tr>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Booking</span>
                    </div>
                </th>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Client</span>
                    </div>
                </th>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Document</span>
                    </div>
                </th>
                <th
                    class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                    <div class="flex cursor-pointer">
                        <span class="mr-2">Action</span>
                    </div>
                </th>
            </tr>
        </thead>';
        } else {
            echo "0 results";
        }
        ;

        while ($row = $res->fetch_assoc()) {
            echo '<tbody class="bg-white divide-y divide-gray-200">
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
            <p>' . $row["Prenotazione"] . '</p>'
                . '</td>
        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
            <p>' . $row["Cliente"] . '</p>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
            <p>' . $row["Document"] . '</p>'
                . '</td>
            <td class="flex justify-start">
            <a href="edit.php?id=' . $row["Prenotazione"] . ' "class="text-blue-500 hover:text-blue-600 pr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <p class="text-center">Edit</p>
            </a>
            <a href="deletesog.php?id=' . $row["Prenotazione"] . ' "class="text-red-500 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 ml-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                <p class="text-center">Delete</p>
            </a>
            </td>
            </tr>
            </tbody>
            </div>';
        }

        ?>




</body>

</html>