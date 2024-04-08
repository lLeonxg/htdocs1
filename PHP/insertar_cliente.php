<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si los campos requeridos están presentes
    if (isset($_POST['nombre']) && isset($_POST['email'])) {
        // Obtener y limpiar los datos de entrada para evitar inyecciones SQL
        $nombre = htmlspecialchars($_POST['nombre']);
        $email = htmlspecialchars($_POST['email']);

        // Preparar la consulta SQL utilizando sentencias preparadas para evitar inyecciones SQL
        $sql = "INSERT INTO clientes (nombre, email) VALUES (?, ?)";
        $statement = $db->prepare($sql);
        $statement->bind_param("ss", $nombre, $email);

        // Ejecutar la consulta
        if ($statement->execute()) {
            $response["status"] = "ok";
            $response["mensaje"] = "Cliente insertado correctamente";
        } else {
            $response["status"] = "error";
            $response["mensaje"] = "Error al insertar el cliente: " . $statement->error;
        }

        // Cerrar la conexión
        $statement->close();
    } else {
        $response["status"] = "error";
        $response["mensaje"] = "Los campos 'nombre' y 'email' son obligatorios";
    }

    echo json_encode($response);
}
?>
