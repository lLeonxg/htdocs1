<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se proporcionaron todos los campos necesarios
    if (isset($_POST['id']) && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['año']) && isset($_POST['no_serie'])) {
        // Obtener y limpiar los datos de entrada para evitar inyecciones SQL
        $id_auto = htmlspecialchars($_POST['id']);
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars($_POST['modelo']);
        $año = htmlspecialchars($_POST['año']);
        $no_serie = htmlspecialchars($_POST['no_serie']);

        // Preparar la consulta SQL utilizando sentencias preparadas para evitar inyecciones SQL
        $sql = "UPDATE autos SET marca = ?, modelo = ?, año = ?, no_serie = ? WHERE id = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param("ssisi", $marca, $modelo, $año, $no_serie, $id_auto);

        // Ejecutar la consulta
        if ($statement->execute()) {
            $response["status"] = "ok";
            $response["mensaje"] = "Auto actualizado correctamente";
        } else {
            $response["status"] = "error";
            $response["mensaje"] = "Error al actualizar el auto: " . $statement->error;
        }

        // Cerrar la conexión
        $statement->close();
    } else {
        $response["status"] = "error";
        $response["mensaje"] = "Todos los campos ('id', 'marca', 'modelo', 'año' y 'no_serie') son obligatorios";
    }

    // Enviar la respuesta en formato JSON
    echo json_encode($response);
}
?>
