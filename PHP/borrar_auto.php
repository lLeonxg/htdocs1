<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se proporcionó el ID del auto a borrar
    if (isset($_POST['id'])) {
        // Obtener y limpiar el ID del auto a borrar para evitar inyecciones SQL
        $id_auto = htmlspecialchars($_POST['id']);

        // Preparar la consulta SQL para borrar el auto por su ID
        $sql = "DELETE FROM autos WHERE id = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param("i", $id_auto);

        // Ejecutar la consulta
        if ($statement->execute()) {
            $response["status"] = "ok";
            $response["mensaje"] = "Auto eliminado correctamente";
        } else {
            $response["status"] = "error";
            $response["mensaje"] = "Error al eliminar el auto: " . $statement->error;
        }

        // Cerrar la conexión
        $statement->close();
    } else {
        $response["status"] = "error";
        $response["mensaje"] = "El campo 'id' del auto a borrar es obligatorio";
    }

    // Enviar la respuesta en formato JSON
    echo json_encode($response);
}
?>
