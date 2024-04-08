<?php

$db_host ='localhost';
$db_username ='usuario';
$db_password= 'cIBVqbzpuO_hC912';
$db_database ='backend';

$db = new mysqli($db_host, $db_username, $db_password, $db_database);

if($db->connect_errno > 0){
    die('No es posible conectarse a la base de datos ['.$db->connect_error.']');
}

mysqli_query($db, "SET NAMES 'utf8'");

?>
