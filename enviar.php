<?php
// Conexión a la base de datos
    $servername = "185.211.7.138:3306";
    $username = "u611396439_biblioteca"; // Cambiar por tu usuario de MySQL
    $password = "Biblioteca2023."; // Cambiar por tu contraseña de MySQL
    $dbname = "u611396439_biblioteca2023";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombrelibro = $_POST["nombrelibro"];
$nombreresponsable = $_POST["nombreresponsable"];
$cursoresponsable = $_POST["cursoresponsable"];
$fechaprestamo = $_POST["fechaprestamo"];
$fechadevolucion = $_POST["fechadevolucion"];

// Insertar los datos en la tabla "prestamos"
$sql = "INSERT INTO prestamos (nombrelibro, nombreresponsable, cursoresponsable, fechaprestamo, fechadevolucion)
        VALUES ('$nombrelibro', '$nombreresponsable', '$cursoresponsable', '$fechaprestamo', '$fechadevolucion')";

if ($conn->query($sql) === TRUE) {
    echo "Préstamo registrado correctamente.";
} else {
    echo "Error al registrar el préstamo: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
