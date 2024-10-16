<?php

    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $bd = "pinnet";

    $conexion = mysqli_connect($servidor, $usuario, $clave) or die('No se encontro el servidor');
    mysqli_select_db($conexion, $bd) or die("No se encontro la base de datos");
    mysqli_set_charset($conexion,"utf8");

    

