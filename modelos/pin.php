<?php

    class Pin{
        public $conexion;
        public function __construct($conexion){
            $this->conexion = $conexion;   
        }

        public function consultar(){
            $sql = "SELECT id_pin AS id, p.nombre AS 'pin', p.perfil, p.precio, p.fecha, e.nombre AS 'estado', u.email AS 'vendedor'
                    FROM pin p
                    INNER JOIN estado e ON p.estado = e.id_estado
                    INNER JOIN usuario u ON p.vendedor = u.documento;";
            $res = mysqli_query($this->conexion, $sql);
            $vec = [];

            while($fila = mysqli_fetch_assoc($res)){
                $vec[] = $fila;
            }

            return $vec;                    
        }

        public function eliminar($id){
            $sql = "DELETE FROM pin WHERE id_pin = '$id'";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El pin ha sido eliminado";
            return $vec;
        }

        public function insertar($valores){
            $sql = "INSERT INTO pin (id_pin, nombre, perfil, precio, fecha, vendedor, estado) 
            VALUES ('$valores->id', '$valores->nombre', '$valores->perfil', '$valores->precio', NOW(), '$valores->vendedor', '$valores->estado');";        
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El pin ha sido guardado";
            return $vec;
        }

        public function editar($id, $valores){
            $sql = "UPDATE pin SET nombre='$valores->nombre', perfil='$valores->perfil', precio='$valores->precio', fecha='$valores->fecha', vendedor='$valores->vendedor', estado='$valores->estado' WHERE id_pin = '$id';";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El pin ha sido editado";
            return $vec;
        }

        public function editarEstado($id, $estado){
            $sql = "UPDATE pin SET estado='$estado' WHERE id_pin = '$id';";
            mysqli_query($this->conexion,$sql);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El estado del pin ha sido cambiado";
            return $vec;
        }

        public function filtro($valor){
            $sql = "SELECT p.nombre AS 'pin', p.perfil, p.precio, p.fecha, e.nombre AS 'estado', u.email AS 'vendedor'
                    FROM pin p
                    INNER JOIN estado e ON p.estado = e.id_estado
                    INNER JOIN usuario u ON p.vendedor = u.documento
                    WHERE p.nombre LIKE '%$valor%' OR p.perfil LIKE '%$valor%' OR p.fecha LIKE '%$valor%' OR u.email LIKE '%$valor%';";
            $res = mysqli_query($this->conexion,$sql);
            $vec = [];  

            while( $fila = mysqli_fetch_assoc($res)){
                $vec[] = $fila;
            }
            
            return $vec;
        }
    }