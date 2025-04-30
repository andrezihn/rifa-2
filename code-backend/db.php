<?php
$host = 'localhost';
$db = 'rifas';
$user = 'root';
$pass = '';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die('Erro na conexão: ' . mysqli_connect_error());
}
?>
