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

// popup to edit the stay

$q = "SELECT * FROM Soggiorni WHERE Prenotazione = $id";

$result = mysqli_query($conn, $q);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='popup'>
        <div class='popup-content'>
            <div class='popup-header'>
                <h1>Modifica prenotazione</h1>
            </div>
            <div class='popup-body'>
                <form action='edit.php' method='POST'>
                    <input type='hidden' name='id' value='$id'>
                    <label for='checkin'>Prenotazione</label>
                    <input type='text' name='prenotazione' value='" . $row['Prenotazione'] . "'>
                    <label for='checkout'>Cliente</label>
                    <input type='text' name='cliente' value='" . $row['Cliente'] . "'>
                    <label for='checkout'>Documento</label>
                    <input type='text' name='documento' value='" . $row['Document'] . "'>
                    <input type='submit' value='Modifica'>
                </form>
            </div>
        </div>
    </div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $prenotazione = $_POST['prenotazione'];
    $cliente = $_POST['cliente'];
    $documento = $_POST['documento'];

    $documento = "'" . $documento . "'";

    $update = "UPDATE Soggiorni SET Document = $documento, Cliente = $cliente WHERE Prenotazione = 1;";

    $result = mysqli_query($conn, $update);

    if ($_COOKIE['admin'] == 1) {
        header("Location: ./admin.php");
    } else {
        header("Location: ./protected.php");
    }
}

?>