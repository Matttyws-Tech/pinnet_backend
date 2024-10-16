<?php

    class Login{
        public $conexion;
        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        public function consultar($email, $clave){
            $sql = "SELECT u.documento,  u.apellido, u.nombre, u.email, r.nombre AS rol
                    FROM usuario u
                    INNER JOIN rol r ON u.rol = r.id_rol
                    WHERE email = '$email' && clave = '$clave'";     

            $res = mysqli_query($this->conexion,$sql);
            $vec = [];

            while($fila = mysqli_fetch_assoc($res)){
                $fila['validar'] = true;
                $vec[] = $fila;
            }

            if ($vec == []) {
                $vec[0] = array("validar" => false);
            }else{
                $vec[0]["validar"]= true;
            }
            return $vec;

        }
    }