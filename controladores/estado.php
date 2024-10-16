<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

    require_once("../conexion.php");
    require_once("../modelos/estado.php");

    $control = $_GET['control'];

    $estado = new Estado($conexion);

    switch ($control) {
        case 'consultar':
            $response = $estado->consultar();            
            break;
        case 'eliminar':
            $id = $_GET['id'];
            $response = $estado->eliminar($id);            
            break;    
        case 'insertar':
            //$valoresJson = '{"nombre":"prueba"}'; #para probar el insert deben esatr todos los campos
            $valoresJson = file_get_contents('php://input');
            $valores = json_decode($valoresJson);              
            $response = $estado->insertar($valores);
            break;   
        case 'editar':
            $valoresJson = file_get_contents('php://input');
            $valores = json_decode($valoresJson);                          
            $id = $_GET['id'];
            $response = $estado->editar($id, $valores);            
            break;
        case 'filtro':
            $dato = $_GET['dato'];
            $response = $estado->filtro( $dato );
            break;
        default:            
            break;
    }

    $resJson = json_encode($response);
    echo $resJson;
    header('Content-Type: application/json');