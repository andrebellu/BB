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

$u = "SELECT Username FROM Clienti WHERE Username = '" . $_POST['username'] . "'";
$check = mysqli_query($conn, $u);
if ($check->num_rows > 0) {
    echo "<script>alert('Username already exists!')</script>";
    echo "<script>window.location.href='../pages/signup.html'</script>";
    exit();
}

$e = "SELECT Email FROM Clienti WHERE Email = '" . $_POST['email'] . "'";
$check = mysqli_query($conn, $e);
if ($check->num_rows > 0) {
    echo "<script>alert('Email already exists!')</script>";
    echo "<script>window.location.href='../pages/signup.html'</script>";
    exit();
}

$q = "INSERT INTO Clienti (Username, Nome, Cognome, Email, Telefono, Password) VALUES ('" . $_POST['username'] . "', '"
    . $_POST['name'] . "', '" . $_POST['surname'] . "', '" . $_POST['email'] . "', '" . $_POST['phone'] . "', '" .
    $passworduser . "')";

if (isset($_POST['username']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['password'])) {
    $result = mysqli_query($conn, $q);
    if ($result) {
        header("Location: ../pages/login.php");
    } else {
        echo "
<script>alert('Username already exists!')</script>";
    }
}
?>