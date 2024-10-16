<?php

    require_once('../routeros_api.class.php'); // Archivo con la clase api

    class Mikrotik{
        private $api;
        public function __construct(){
            $this->api = new Routerosapi();
        }

        public function conectar($ip, $usuario, $clave){
            if ($this->api->connect($ip, $usuario, $clave)) {
                return true;
            }else {
                return false;
            }
        }

        public function pinesGenerados(){                
                            
            $this->api->write('/ip/hotspot/user/print');                        
            return $this->api->read();        
        }

        public function insertarPin($nombre, $perfil, $tiempoLimite){
            
            $this->api->write('/ip/hotspot/user/add', false);
            $this->api->write('=server=all', false);
            $this->api->write('=name=' . $nombre, false);
            $this->api->write('=password=' . $nombre, false);
            $this->api->write('=profile=' . $perfil, false);
            $this->api->write('=limit-uptime=' . $tiempoLimite);                
            return $this->api->read();                   

        }

        public function perfiles(){
            $this->api->write('/ip/hotspot/user/profile/print');
            return $this->api->read();
        }

        public function pinesEnUso(){                
                            
            $this->api->write('/ip/hotspot/active/print');                        
            return $this->api->read();        
        }
        public function eliminarPinActivo($id){
            $this->api->comm("/ip/hotspot/active/remove", [
                ".id" => $id
            ]);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"]= 'pin activo sin acceso';

            return $vec;
        }

        public function eliminarPin($id){
            $this->api->comm("/ip/hotspot/user/remove", [
                ".id" => $id
            ]);
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"]= 'Pin eliminado del router';

            return $vec;
        }
        
        public function cerrarConexion() {
            $this->api->disconnect();
        }

    
    }