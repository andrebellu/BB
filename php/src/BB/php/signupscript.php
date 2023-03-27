<?php
$passworduser = password_hash($_POST['password'], PASSWORD_DEFAULT);

$id = $_GET['id'];
$hostname = 'mariadb';
$dbname = 'BB';
$username = 'root';
$password = 'pippo';

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}

$q = "INSERT INTO Clienti (Username, Nome, Cognome, Email, Telefono, Password) VALUES ('" . $_POST['username'] . "', '"
    . $_POST['name'] . "', '" . $_POST['surname'] . "', '" . $_POST['email'] . "', '" . $_POST['phone'] . "', '" .
    $passworduser . "')";

if (isset($_POST['username']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['password'])) {
    $result = mysqli_query($conn, $q);
    if ($result) {
        header("Location: ../pages/login.html");
    } else {
        echo "
<script>alert('Username already exists!')</script>";
    }
}
?>