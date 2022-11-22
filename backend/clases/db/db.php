<?php
    class db{
        private $server;
        private $user;
        private $password;
        private $database;
        private $port;
        private $conection;

        function __construct(){
            $listData = $this->dataDB();
            foreach ($listData as $key => $value){
                $this->server = $value['server'];
                $this->user = $value['user'];
                $this->password = $value['password'];
                $this->database = $value['database'];
                $this->port = $value['port'];
            }
            $this->conection = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port );
            if($this->conection->connect_errno){
                echo "error con la conexión";
                die();
            }
        }
        //usa el archivo de texto para los valores necesarios para la conexión
        private function dataDB(){
            $direction = dirname(__FILE__);
            $jsondata = file_get_contents($direction. "/". "config");
            return json_decode($jsondata, true);
        }
        //aceptar caracteres especiales de escritura en español
        private function convertUTF8($array){
            array_walk_recursive($array, function(&$item, $key){
                if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_decode($item);
                }

            });
            return $array;
        }

        //consulta
        public function getData($query){
            $result = $this->conection->query($query);
            $resultArray = array();
            foreach($result as $key){
                $resultArray[] = $key;
            }
            return $this->convertUTF8($resultArray);
        }

        //insertar

        public function insert($query){
            $result = $this->conection->query($query);
            return $this->conection->affected_rows; 

        }

        //insertar y devolver una id
      
        public function insertId($query){
            $results = $this->conection->query($query);
            $filas = $this->conection->affected_rows;
             if($filas >= 1){
                return $this->conection->insert_id;
             }else{
                 return 0;
             }
        }
    }

?>  