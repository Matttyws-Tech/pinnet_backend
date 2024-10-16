<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Content-Type: application/json');
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

    require_once('../modelos/mikrotik.php');

    $control = $_GET['control'];

    $ip = '192.168.14.1';
    $usuario = 'owen';
    $clave = 'Nw140206.';

    $mikrotik = new Mikrotik();

    if ($mikrotik->conectar($ip, $usuario, $clave)) {
        switch ($control) {            
            case 'usuarios':
                $response = $mikrotik->pinesGenerados();
                break;
            case 'usuariosactivos':
                $response = $mikrotik->pinesEnUso();
                break;
            case 'perfiles':
                $response = $mikrotik->perfiles();
                break;
            case 'crearpin':
                $nombre = $_GET['nombre'];
                $perfil = $_GET['perfil'];
                $tiempoLimite = $_GET['tiempolimite'];
                $response = $mikrotik->insertarPin($nombre, $perfil, $tiempoLimite);                
                break;
            case 'eliminarpinactivo':
                $id = $_GET['id'];
                $response = $mikrotik->eliminarPinActivo($id);
                break;
            case 'eliminarpin':
                $id = $_GET['id'];
                $response = $mikrotik->eliminarPin($id);
                break;
            default:                
                break;
        }
        $mikrotik->cerrarConexion();
    } else {
        $response = array('error' =>'No se pudo conectar al router');
    }

    echo json_encode($response);
    