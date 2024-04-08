<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = 'SELECT * FROM clientes';
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $arrClientes = array();
        while ($fila = $result->fetch_assoc()) {
            $items['id'] = $fila['id'];
            $items['nombre'] = $fila['nombre'];
            $items['email'] = $fila['email'];
            $arrClientes[] = $items;
        }
        $response["status"] = "ok";
        $response["mensaje"] = $arrClientes;
    } else {
        $response["status"] = "error";
        $response["mensaje"] = "No hay clientes registrados";
    }

    echo json_encode($response);
}
?>
