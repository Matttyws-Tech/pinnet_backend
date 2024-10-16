<?php

    class Estado{

        public $conexion;
        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        public function consultar(){
            $sql = "SELECT * FROM estado";
            $res = mysqli_query($this->conexion,$sql);
            $vec = [];

            while($fila = mysqli_fetch_assoc($res)){
                $vec[] = $fila;
            }

            return $vec;
        }

        public function eliminar($id){
            $sql = "DELETE FROM estado WHERE id_estado = '$id'";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El estado ha sido eliminado";
            return $vec;
        }

        public function insertar($valores){
            $sql = "INSERT INTO estado (nombre) VALUES('$valores->nombre')";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El estado ha sido guardado";
            return $vec;
        }

        public function editar($id, $valores){
            $sql = "UPDATE estado SET nombre = '$valores->nombre' WHERE id_estado = $id";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El estado ha sido editado";
            return $vec;
        }

        public function filtro($valor){
            $sql = "SELECT * FROM estado WHERE nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion,$sql);
            $vec = [];  

            while( $fila = mysqli_fetch_assoc($res)){
                $vec[] = $fila;
            }
            
            return $vec;
        }

        
    }