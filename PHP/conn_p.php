<?php

$db_host ='localhost';
$db_username ='usuario';
$db_password= 'cIBVqbzpuO_hC912';
$db_database ='alumnos';

$db = new mysqli($db_host, $db_username, $db_password, $db_database);
mysqli_query($db, "SET NAMES 'utf8'");

if($db->connect_errno > 0){
    die('no es posible conectarse a la base de datos ['.$db ->connect_error.']');
}