<?php
$hostname = 'mariadb';
$dbname = 'BB';
$user = 'root';
$password = 'pippo';

$username = $_POST['username'];
$userpassword = $_POST['password'];

$conn = mysqli_connect($hostname, $user, $password, $dbname);

if ($conn->connect_errno) {
    die("Connection failed: " . mysqli_connect_error());
}
;

$q = "SELECT Codice, Username, Admin, Password FROM Clienti";

$res = mysqli_query($conn, $q);

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        if ($username == $row['Username'] && password_verify($userpassword, $row['Password'])) {
            setcookie('id', $row['Codice'], time() + 3600, '/');
            setcookie('admin', $row['Admin'], time() + 3600, '/');
            if ($row['Admin'] == true) {
                header("Location: ../pages/auth/adminpage.php");
            } else {
                header("Location: ../pages/auth/userpage.php");
            }
        } else {
            header("Location: ../pages/login.php");
        }
    }
} else {
    header("Location: ../pages/login.php");
}

?>