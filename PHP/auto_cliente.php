<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Verificar si se proporcionó el ID del cliente
    if (isset($_GET['id_cliente'])) {
        // Obtener y limpiar el ID del cliente para evitar inyecciones SQL
        $id_cliente = htmlspecialchars($_GET['id_cliente']);

        // Preparar la consulta SQL para obtener los autos de un cliente mediante un JOIN
        $sql = "SELECT autos.* FROM autos JOIN clientes ON autos.dueño_id = clientes.id WHERE clientes.id = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param("i", $id_cliente);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $arrAutos = array();
            while ($fila = $result->fetch_assoc()) {
                $items['id'] = $fila['id'];
                $items['marca'] = $fila['marca'];
                $items['modelo'] = $fila['modelo'];
                $items['año'] = $fila['año'];
                $items['no_serie'] = $fila['no_serie'];
                $arrAutos[] = $items;
            }
            $response["status"] = "ok";
            $response["mensaje"] = $arrAutos;
        } else {
            $response["status"] = "error";
            $response["mensaje"] = "El cliente no tiene autos registrados";
        }

        // Cerrar la conexión
        $statement->close();

        // Enviar la respuesta en formato JSON
        echo json_encode($response);
    } else {
        $response["status"] = "error";
        $response["mensaje"] = "El campo 'id_cliente' es obligatorio";
        echo json_encode($response);
    }
}
?>
