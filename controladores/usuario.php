<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

    require_once("../conexion.php");
    require_once("../modelos/usuario.php");

    $control = $_GET['control'];

    $usuario = new Usuario($conexion);

    switch ($control) {
        case 'consultar':
            $response = $usuario->consultar();            
            break;
        case 'eliminar':
            $id = $_GET['id'];
            $response = $usuario->eliminar($id);            
            break;    
        case 'insertar':            
            $valoresJson = file_get_contents('php://input');
            $valores = json_decode($valoresJson);              
            $response = $usuario->insertar($valores);
            break;   
        case 'editar':            
            $valoresJson = file_get_contents('php://input');
            $valores = json_decode($valoresJson);                          
            $id = $_GET['id'];
            $response = $usuario->editar($id, $valores);            
            break;
        case 'filtro':
            $dato = $_GET['dato'];
            $response = $usuario->filtro( $dato );
            break;
        default:            
            break;
    }

    $resJson = json_encode($response);
    echo $resJson;
    header('Content-Type: application/json');