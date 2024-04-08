<?php
// Incluir el archivo de conexión a la base de datos y las funciones de los endpoints
include('conn.php');

// Endpoint para insertar un nuevo cliente
function insertarCliente($nombre, $email) {
    global $db;

    // Preparar la consulta SQL utilizando sentencias preparadas para evitar inyecciones SQL
    $sql = "INSERT INTO clientes (nombre, email) VALUES (?, ?)";
    $statement = $db->prepare($sql);
    $statement->bind_param("ss", $nombre, $email);

    // Ejecutar la consulta
    if ($statement->execute()) {
        return true; // Cliente insertado correctamente
    } else {
        return false; // Error al insertar el cliente
    }
}

// Endpoint para insertar un nuevo auto
function insertarAuto($marca, $modelo, $año, $no_serie) {
    global $db;

    // Preparar la consulta SQL utilizando sentencias preparadas para evitar inyecciones SQL
    $sql = "INSERT INTO autos (marca, modelo, año, no_serie) VALUES (?, ?, ?, ?)";
    $statement = $db->prepare($sql);
    $statement->bind_param("ssis", $marca, $modelo, $año, $no_serie);

    // Ejecutar la consulta
    if ($statement->execute()) {
        return true; // Auto insertado correctamente
    } else {
        return false; // Error al insertar el auto
    }
}

// Endpoint para asociar un auto a un cliente
function asociarAutoCliente($id_cliente, $id_auto) {
    global $db;

    // Preparar la consulta SQL utilizando sentencias preparadas para evitar inyecciones SQL
    $sql = "INSERT INTO clientes_autos (id_cliente, id_auto) VALUES (?, ?)";
    $statement = $db->prepare($sql);
    $statement->bind_param("ii", $id_cliente, $id_auto);

    // Ejecutar la consulta
    if ($statement->execute()) {
        return true; // Asociación realizada correctamente
    } else {
        return false; // Error al asociar el auto al cliente
    }
}
if (insertarCliente("Juan", "juan@example.com")) {
    echo "Cliente insertado correctamente.<br>";
} else {
    echo "Error al insertar el cliente.<br>";
}

if (insertarAuto("Toyota", "Corolla", 2020, "ABC123")) {
    echo "Auto insertado correctamente.<br>";
} else {
    echo "Error al insertar el auto.<br>";
}

$id_cliente = 1;
$id_auto = 1;

if (asociarAutoCliente($id_cliente, $id_auto)) {
    echo "Auto asociado al cliente correctamente.<br>";
} else {
    echo "Error al asociar el auto al cliente.<br>";
}
?>
