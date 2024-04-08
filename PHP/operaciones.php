<?php
include('conn.php');

if(isset($_GET['accion'])){
    $accion = $_GET['accion'];

    //leer los datos de la tabla usuarios
    if($accion == 'leer'){
        $sql = 'SELECT *from alumnos';
        $result = $db->query($sql);

        if($result->num_rows>0){
            while($fila = $result->fetch_assoc()){
                $items['id'] = $fila['id'];
                $items['alumnos'] = $fila['alumnos'];
                $items['apellido_paterno'] = $fila['apellido_paterno'];
                $items['apellido_materno'] = $fila['apellido_materno'];
                $arrAlumnos[] = $items;
            }
            $response["status"]= "ok";
            $response["mensaje"] = $arrAlumnos;

        }else{
            $response["status"] = "error";
            $response["mensaje"] = "no hay alumnos registrados";
        }
    }
    echo json_encode($response);
    if($accion = 'insertar'){
        
    }
}

