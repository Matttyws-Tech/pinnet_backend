<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

    require_once("../conexion.php");
    require_once("../modelos/pin.php");

    $control = $_GET['control'];

    $pin = new Pin($conexion);

    switch ($control) {
        case 'consultar':
            $response = $pin->consultar();            
            break;
        case 'eliminar':
            $id = $_GET['id'];
            $response = $pin->eliminar($id);            
            break;    
        case 'insertar':
            //$valoresJson = '{"nombre":"prueba", "perfil":"12 horas", "precio":"1300", "fecha":"2024-09-22", "vendedor":"1081793971", "estado":"1"}'; #para probar el insert deben esatr todos los campos
            $valoresJson = file_get_contents('php://input');
            $valores = json_decode($valoresJson);              
            $response = $pin->insertar($valores);
            break;   
        case 'editar':
            //$valoresJson = '{"nombre":"bbbbb", "perfil":"1 hora", "precio":"500", "fecha":"2024-09-22", "vendedor":"1081793971", "estado":"1"}';
            $valoresJson = file_get_contents('php://input');
            $valores = json_decode($valoresJson);                          
            $id = $_GET['id'];
            $response = $pin->editar($id, $valores);            
            break;
        case 'editarestado':
            $id = $_GET['id'];
            $estado = $_GET['estado'];
            $response = $pin->editarEstado($id, $estado);
            break;
        case 'filtro':
            $dato = $_GET['dato'];
            $response = $pin->filtro( $dato );
            break;
        default:            
            break;
    }

    $resJson = json_encode($response);
    echo $resJson;
    header('Content-Type: application/json');