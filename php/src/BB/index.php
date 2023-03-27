<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Bed & Breakfast</title>

    <link rel="stylesheet" href="./style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
</head>

<style>
    html,
    body {
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        scroll-behavior: smooth;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    body {
        background-color: rgb(255, 255, 255);
    }

    .title {
        font-family: 'Philosopher', sans-serif;
    }
</style>

<body>

    <div class="scroll-container">

        <section class="page-1">
            <div class="navbar flex justify-between title text-black absolute z-20">
                <div class="px-4">
                    <a class="text-2xl title">Swan B&B</a>
                </div>
                <div class="nav-links">
                    <div class="tabs">
                        <a class="tab tab-bordered title text-xl" href="./pages/about.html">About</a>
                        <a class="tab tab-bordered title text-xl" href="./php/book.php">Book</a>
                        <a class="tab tab-bordered title text-xl" href="./pages/login.html">Profile</a>
                    </div>
                </div>
            </div>
            <div class="page-1-content flex flex-col justify-center ml-32">
                <p class="text-6xl text-black leading-none text-left">Premium Accomodation</p>
                <p class="text-5xl text-black leading-none text-left">in the Heart of the city</p>
                <p class="text-sm text-black text-left pt-2">
                    Wake up to the delicious smell of a homemade
                    breakfast made with fresh, local ingredients.
                </p>
                <p class="text-sm text-black text-left">
                    Enjoy your meal in our cozy dining room or on our
                    lovely outdoor patio.
                </p>

            </div>
        </section>

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

        $q = "SELECT * FROM Camere";

        $res = mysqli_query($conn, $q);

        echo '<section class="page-2">
        <h1 class="text-black text-6xl text-center pt-10">Our rooms</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10">';

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo "<div class='bg-white rounded-lg shadow-lg p-4 mx-2'>
                <div class='flex flex-col items-center'>
                    <div class='w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center'>
                        <svg class='w-10 h-10 text-gray-400' fill='currentColor' viewBox='0 0 20 20'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path d='M10 12a2 2 0 100-4 2 2 0 000 4zm0 2a4 4 0 100-8 4 4 0 000 8z'>
                            </path>
                            <path fill-rule='evenodd'
                                d='M10 18a8 8 0 100-16 8 8 0 000 16zm0 2a10 10 0 100-20 10 10 0 000 20z'
                                clip-rule='evenodd'>
                            </path>
                        </svg>
                    </div>
                    <div class='mt-3 text-center'>
                        <h3 class='text-gray-700 font-semibold text-lg'>" . $row['Descrizione'] . "</h3>
                        <p class='text-gray-600 text-xs'>For " . $row['Posti'] . " Person</p>
                    </div>
                    <div class='mt-3 text-center'>
                        <p class='text-gray-600 text-xs'>€ " . $row['Costo'] . ",00</p>
                    </div>
                    <div class='mt-3 text-center'>
                        <button
                            class='px-4 py-2 bg-gray-800 text-white rounded-lg text-xs font-semibold'>Book</button>
                    </div>
                </div>
            </div>";
            }
        }

        echo '</div>
        </section>';

        ?>

    </div>

</body>

</html>