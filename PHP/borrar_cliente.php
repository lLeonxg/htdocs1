<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se proporcionó el ID del cliente a borrar
    if (isset($_POST['id'])) {
        // Obtener y limpiar el ID del cliente a borrar para evitar inyecciones SQL
        $id_cliente = htmlspecialchars($_POST['id']);

        // Preparar la consulta SQL para borrar el cliente por su ID
        $sql = "DELETE FROM clientes WHERE id = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param("i", $id_cliente);

        // Ejecutar la consulta
        if ($statement->execute()) {
            $response["status"] = "ok";
            $response["mensaje"] = "Cliente eliminado correctamente";
        } else {
            $response["status"] = "error";
            $response["mensaje"] = "Error al eliminar el cliente: " . $statement->error;
        }

        // Cerrar la conexión
        $statement->close();
    } else {
        $response["status"] = "error";
        $response["mensaje"] = "El campo 'id' del cliente a borrar es obligatorio";
    }

    // Enviar la respuesta en formato JSON
    echo json_encode($response);
}
?>
