<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se proporcionaron todos los campos necesarios
    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['email'])) {
        // Obtener y limpiar los datos de entrada para evitar inyecciones SQL
        $id_cliente = htmlspecialchars($_POST['id']);
        $nombre = htmlspecialchars($_POST['nombre']);
        $email = htmlspecialchars($_POST['email']);

        // Preparar la consulta SQL utilizando sentencias preparadas para evitar inyecciones SQL
        $sql = "UPDATE clientes SET nombre = ?, email = ? WHERE id = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param("ssi", $nombre, $email, $id_cliente);

        // Ejecutar la consulta
        if ($statement->execute()) {
            $response["status"] = "ok";
            $response["mensaje"] = "Cliente actualizado correctamente";
        } else {
            $response["status"] = "error";
            $response["mensaje"] = "Error al actualizar el cliente: " . $statement->error;
        }

        // Cerrar la conexión
        $statement->close();
    } else {
        $response["status"] = "error";
        $response["mensaje"] = "Todos los campos ('id', 'nombre' y 'email') son obligatorios";
    }

    // Enviar la respuesta en formato JSON
    echo json_encode($response);
}
?>
