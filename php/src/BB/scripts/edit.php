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

$q = "SELECT * FROM Soggiorni WHERE Prenotazione = $id";

$result = mysqli_query($conn, $q);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo '<div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
          <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-semibold text-black">Modifica prenotazione</h1>
          </div>
          <div>
            <form action="edit.php" method="POST">
              <input type="hidden" name="id" value="$id">
              <div class="mb-4">
                <label for="checkin" class="block text-sm font-medium text-black">Prenotazione</label>
                <input type="text" name="prenotazione" value="' . $row['Prenotazione'] . '" class="w-full mt-1 p-2 border border-gray-300 rounded" readonly="readonly">
              </div>
              <div class="mb-4">
                <label for="checkout" class="block text-sm font-medium text-black">Cliente</label>
                <input type="text" name="cliente" value="' . $row['Cliente'] . '" class="w-full mt-1 p-2 border border-gray-300 rounded" readonly="readonly">
                </div>
                <div class="mb-4">
                <label for="checkout" class="block text-sm font-medium text-black">Documento</label>
                <select name="documento" class="w-full mt-1 p-2 border border-gray-300 rounded">
                <option value="ID">ID</option>
                <option value="DL">Driving Licence</option>
                <option value="PP">Passport</option>
                </select>
                </div>
                <div class="flex justify-end">
                <input type="submit" value="Modifica" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 cursor-pointer transition-all duration-300">
                </div>
            </form>
            </div>
        </div>
    </div>';
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $prenotazione = $_POST['prenotazione'];
  $cliente = $_POST['cliente'];
  $documento = $_POST['documento'];

  $documento = "'" . $documento . "'";

  $update = "UPDATE Soggiorni SET Document = $documento, Cliente = $cliente WHERE Prenotazione = $prenotazione;";

  $result = mysqli_query($conn, $update);

  if ($_COOKIE['admin'] == true) {
    echo '<script>window.location.href = "../pages/auth/adminpage.php";</script>';
  } else {
    echo '<script>window.location.href = "../pages/auth/userpage.php";</script>';
  }
}

?>