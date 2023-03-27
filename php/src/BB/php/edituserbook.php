<link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.3/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Philosopher&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

<?php
$id = $_GET['id'];

$hostname = 'mariadb';
$dbname = 'BB';
$username = 'root';
$password = 'pippo';

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if ($conn->connect_errno) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM Prenotazioni WHERE id = $id";

$roomsq = "SELECT * FROM Camere";

$result = mysqli_query($conn, $query);
$rooms = mysqli_query($conn, $roomsq);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='flex flex-col items-center justify-center'>
    <form action='./edituserbook.php' method='POST'>
        <div class='flex flex-col items-center justify-center'>
            <label for='prenotazione'>Prenotazione</label>
            <input type='text' name='prenotazione' id='prenotazione' value='$id' readonly>
        </div>
        <div class='flex flex-col items-center justify-center'>
            <label for='cliente'>Cliente</label>
            <input type='text' name='cliente' id='cliente' value='" . $_COOKIE['id'] . "' readonly>
        </div>
        <div class='flex flex-col items-center justify-center'>
            <label for='camera'>Camera</label>
            <select name='camera' id='camera' required>
                <option value=''>Seleziona una camera</option>";
    while ($row = mysqli_fetch_assoc($rooms)) {
        echo "<option value='" . $row['Numero'] . "'>" . $row['Descrizione'] . "</option>";
    }
    echo "</select>
        </div>
        <div class='flex flex-col items-center justify-center'>
            <label for='checkin'>Check-in</label>
            <input type='date' name='checkin' id='checkin' required value='" . $row['DataArrivo'] . "'>
        </div>
        <div class='flex flex-col items-center justify-center'>
            <label for='checkout'>Check-out</label>
            <input type='date' name='checkout' id='checkout' required value='" . $row['DataPartenza'] . "'>
        </div>

        <div class='flex flex-col items-center justify-center'>
            <input type='submit' value='Modifica prenotazione' class='btn'>
        </div>
    </form>
</div>";


}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $prenotazione = $_POST['prenotazione'];
    $cliente = $_POST['cliente'];
    $camera = $_POST['camera'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    $q = "UPDATE Prenotazioni SET Cliente = $cliente, Camera = $camera, DataArrivo = '$checkin', DataPartenza = '$checkout' WHERE id = $prenotazione";

    if (mysqli_query($conn, $q)) {
        echo "<script>alert('Prenotazione modificata con successo!'); window.location.href = './protected.php';</script>";
    } else {
        echo "<script>alert('Errore durante la modifica della prenotazione!'); window.location.href = './protected.php';</script>";
    }

    mysqli_close($conn);
}

?>