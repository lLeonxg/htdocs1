<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si los campos requeridos están presentes
    if (isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['año']) && isset($_POST['no_serie'])) {
        // Obtener y limpiar los datos de entrada para evitar inyecciones SQL
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars($_POST['modelo']);
        $año = htmlspecialchars($_POST['año']);
        $no_serie = htmlspecialchars($_POST['no_serie']);

        // Preparar la consulta SQL utilizando sentencias preparadas para evitar inyecciones SQL
        $sql = "INSERT INTO autos (marca, modelo, año, no_serie) VALUES (?, ?, ?, ?)";
        $statement = $db->prepare($sql);
        $statement->bind_param("ssis", $marca, $modelo, $año, $no_serie);

        // Ejecutar la consulta
        if ($statement->execute()) {
            $response["status"] = "ok";
            $response["mensaje"] = "Auto insertado correctamente";
        } else {
            $response["status"] = "error";
            $response["mensaje"] = "Error al insertar el auto: " . $statement->error;
        }

        // Cerrar la conexión
        $statement->close();
    } else {
        $response["status"] = "error";
        $response["mensaje"] = "Los campos 'marca', 'modelo', 'año' y 'no_serie' son obligatorios";
    }

    echo json_encode($response);
}
?>
