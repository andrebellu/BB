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
;

$q = "DELETE FROM Prenotazioni WHERE id = $id";

$result = mysqli_query($conn, $q);

if ($_COOKIE['admin'] == 1) {
    header("Location: ../pages/auth/adminpage.php");
} else {
    header("Location: ../pages/auth/userpage.php");
}
?>