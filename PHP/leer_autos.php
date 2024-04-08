<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = 'SELECT * FROM autos';
    $result = $db->query($sql);

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
        $response["mensaje"] = "No hay autos registrados";
    }

    echo json_encode($response);
}
?>
