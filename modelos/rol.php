<?php

    class Rol{

        public $conexion;
        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        public function consultar(){
            $sql = "SELECT * FROM rol";
            $res = mysqli_query($this->conexion,$sql);
            $vec = [];

            while($fila = mysqli_fetch_assoc($res)){
                $vec[] = $fila;
            }

            return $vec;
        }

        public function eliminar($id){
            $sql = "DELETE FROM rol WHERE id_rol = '$id'";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El rol ha sido eliminado";
            return $vec;
        }

        public function insertar($valores){
            $sql = "INSERT INTO rol (nombre) VALUES('$valores->nombre')";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El rol ha sido guardado";
            return $vec;
        }

        public function editar($id, $valores){
            $sql = "UPDATE rol SET nombre = '$valores->nombre' WHERE id_rol = $id";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El rol ha sido editado";
            return $vec;
        }

        public function filtro($valor){
            $sql = "SELECT * FROM rol WHERE nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion,$sql);
            $vec = [];  

            while( $fila = mysqli_fetch_assoc($res)){
                $vec[] = $fila;
            }
            
            return $vec;
        }

        
    }