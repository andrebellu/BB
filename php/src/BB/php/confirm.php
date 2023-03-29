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

$iduser = $_COOKIE['id'];


$conn = mysqli_connect($hostname, $username, $password, $dbname);

if ($conn->connect_errno) {
    die("Connection failed: " . mysqli_connect_error());
}
;

echo '<div class="fixed inset-0 flex items-center justify-center z-50">
<div class="bg-white p-6 rounded-lg shadow-lg w-96">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-semibold text-black">Conferma prenotazione</h1>
  </div>
  <div>
<form action="./confirm.php" method="post">
    <label for="prenotazione">Prenotazione</label>
    <input type="text" name="prenotazione" id="prenotazione" value="' . $id . '" class="w-full mt-1 p-2 border border-gray-300 rounded" readonly>
    <label for="cliente">Cliente</label>
    <input type="text" name="cliente" id="cliente" value="' . $iduser . '" class="w-full mt-1 p-2 border border-gray-300 rounded" readonly>
    <label for="document">Document</label>
    <select name="documento" class="w-full mt-1 p-2 border border-gray-300 rounded">
        <option value="ID">ID</option>
        <option value="DL">Driving Licence</option>
        <option value="PP">Passport</option>
    </select>
    <div class="flex justify-end pt-4">
    <input type="submit" value="Confirm" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 cursor-pointer transition-all duration-300">
    </div></form>
</div>
        </div>
    </div>';
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