<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "dihaus";

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $databasename);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Establecer charset
mysqli_set_charset($conn, "utf8mb4");
?>