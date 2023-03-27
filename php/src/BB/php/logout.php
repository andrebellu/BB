<?php
setcookie('id', '', time() - 3600, '/');
setcookie('admin', '', time() - 3600, '/');
header("Location: ../pages/login.php");
?>