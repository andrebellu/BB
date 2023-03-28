<?php
$id = $_GET['id'];
$hostname = 'mariadb';
$dbname = 'BB';
$username = 'root';
$password = 'pippo';

$iduser = $_COOKIE['id'];


$conn = mysqli_connect($hostname, $username, $password, $dbname);

if ($conn->connect_errno) {
    die("Connection failed: " . mysqli_connect_error());
}
;

// create a form with "Prenotazione" and "Cliente" and "Document" fields

echo '<form action="./confirm.php" method="post">
    <label for="prenotazione">Prenotazione</label>
    <input type="text" name="prenotazione" id="prenotazione" value="' . $id . '" readonly>
    <label for="cliente">Cliente</label>
    <input type="text" name="cliente" id="cliente" value="' . $iduser . '" readonly>
    <label for="document">Document</label>
    <select name="documento" class="w-full mt-1 p-2 border border-gray-300 rounded">
        <option value="ID">Carta D\'Identità</option>
        <option value="DL">Patente</option>
        <option value="PP">Passaporto</option>
    </select>
    <input type="submit" value="Conferma">
</form>';
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $prenotazione = $_POST['prenotazione'];
    $cliente = $_POST['cliente'];
    $documento = $_POST['documento'];

    $q = "INSERT INTO Soggiorni (Prenotazione, Cliente, Document) VALUES ('$prenotazione', '$cliente', '$documento')";

    $result = mysqli_query($conn, $q);

    if ($result) {
        echo '<script>alert("Prenotazione confermata");</script>';
    } else {
        echo '<script>alert("Errore nella conferma della prenotazione");</script>';
    }

    if ($_COOKIE['admin']) {
        echo '<script>window.location.href = "./admin.php";</script>';
    } else {
        echo '<script>window.location.href = "./protected.php";</script>';
    }
}