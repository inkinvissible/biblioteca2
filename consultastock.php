<?php
// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre del libro desde el formulario
    $nombre_libro = $_POST["nombre_libro"];

    
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

    // Preparar la consulta SQL para buscar el libro en la tabla "stock"
    $sql = "SELECT * FROM stock WHERE libros = '$nombre_libro'";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si se encontró el libro
    if ($result->num_rows > 0) {
        echo "<p>El libro \"$nombre_libro\" se encuentra en stock.</p>";
    } else {
        echo "<p>El libro \"$nombre_libro\" no se encuentra en stock.</p>";
    }

    // Cerrar la conexión
    $conn->close();
}
?>
