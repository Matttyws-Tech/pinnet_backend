<?php

    class Usuario{
        public $conexion;
        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        public function consultar(){
            $sql = "SELECT u.documento,  u.apellido, u.nombre, u.celular, u.email, u.clave, r.nombre AS rol, r.id_rol
                    FROM usuario u
                    INNER JOIN rol r ON u.rol = r.id_rol
                    ORDER BY apellido;";
            $res = mysqli_query($this->conexion,$sql);
            $vec = [];

            while($fila = mysqli_fetch_assoc($res)){
                $vec[] = $fila;
            }

            return $vec;
        }

        public function eliminar($id){
            $sql = "DELETE FROM usuario WHERE documento = '$id'";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El usuario ha sido eliminado";
            return $vec;
        }

        public function insertar($valores){
            $sql = "INSERT INTO usuario (documento, nombre, apellido, celular, email, clave, rol) 
            VALUES ('$valores->documento','$valores->nombre', '$valores->apellido', '$valores->celular', '$valores->email', '$valores->clave', '$valores->rol');";        
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El usuario ha sido guardado";
            return $vec;
        }

        public function editar($id, $valores){
            $sql = "UPDATE usuario SET documento='$valores->documento', nombre='$valores->nombre', apellido='$valores->apellido', celular='$valores->celular', email='$valores->email', clave='$valores->clave', rol='$valores->rol' WHERE documento = '$id';";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El usuario ha sido editado";
            return $vec;
        }

        public function filtro($valor){
            $sql = "SELECT u.documento,  u.apellido, u.nombre, u.celular, u.email, r.nombre AS rol
                    FROM usuario u
                    INNER JOIN rol r ON u.rol = r.id_rol
                    WHERE u.documento LIKE '%$valor%' OR u.nombre LIKE '%$valor%' OR u.email LIKE '%$valor%' OR rol LIKE '%$valor%';";
            $res = mysqli_query($this->conexion,$sql);
            $vec = [];  

            while( $fila = mysqli_fetch_assoc($res)){
                $vec[] = $fila;
            }
            
            return $vec;
        }

    }