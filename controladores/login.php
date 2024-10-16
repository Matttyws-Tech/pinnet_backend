<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

    require_once("../conexion.php");
    require_once("../modelos/login.php");

    $email = $_GET['email'];
    $clave = $_GET['clave'];

    $login = new Login($conexion);

    
    $response = $login->consultar($email, $clave);  
    

    $resJson = json_encode($response);
    echo $resJson;
    header('Content-Type: application/json');