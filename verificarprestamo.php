<?php
// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre del libro desde el formulario
    $nombrelibro = $_POST["nombrelibro"];

   // Conexión a la base de datos
    $servername = "185.211.7.138:3306";
    $username = "u611396439_biblioteca"; // Cambiar por tu usuario de MySQL
    $password = "Biblioteca2023."; // Cambiar por tu contraseña de MySQL
    $dbname = "u611396439_biblioteca2023";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Verificar si el libro está en stock y disponible para préstamo
    $sql = "SELECT * FROM stock WHERE libros = '$nombrelibro' AND disponibilidad = 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // El libro está en stock y disponible para préstamo, realizar el préstamo
        $nombreresponsable = $_POST["nombreresponsable"];
        $cursoresponsable = $_POST["cursoresponsable"];
        $fechaprestamo = $_POST["fechaprestamo"];
        $fechadevolucion = $_POST["fechadevolucion"];

        // Insertar los datos en la tabla "prestamos"
        $sql_prestamo = "INSERT INTO prestamos (nombrelibro, nombreresponsable, cursoresponsable, fechaprestamo, fechadevolucion)
                        VALUES ('$nombrelibro', '$nombreresponsable', '$cursoresponsable', '$fechaprestamo', '$fechadevolucion')";

        if ($conn->query($sql_prestamo) === TRUE) {
            // El préstamo se realizó correctamente, actualizar el estado del libro en "stock"
            $sql_actualizar_stock = "UPDATE stock SET disponibilidad = 0 WHERE libros = '$nombrelibro'";
            if ($conn->query($sql_actualizar_stock) === TRUE) {
                $response = "El prestamo del libro \"$nombrelibro\" se realizo correctamente.";
            } else {
                $response = "Error al actualizar la disponibilidad del libro: " . $conn->error;
            }
        } else {
            $response = "Error al registrar el préstamo: " . $conn->error;
        }
    } else {
        // El libro no está en stock o no está disponible para préstamo, mostrar mensaje de error
        $response = "El libro \"$nombrelibro\" no esta disponible para prestamo.";
    }

    // Cerrar la conexión
    $conn->close();

    // Devolver el resultado como una cadena JSON
    echo json_encode(array("message" => $response));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="registro.html">VOLVER</a>
</body>
</html> 