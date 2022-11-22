<?php
    require_once 'db/db.php';
    require_once 'response.class.php';
    class producto extends db{

        public function listAllProducts(){
            $query = "SELECT * FROM producto";
            $data = parent::getData($query);
            return ($data);
        }

        public function getProduct($id){
            $query = "SELECT * FROM producto where id = '$id'";
            $data = parent::getData($query);
            return ($data);            

        }
        public function createProducto($req){
            $_respose = new response;
            $data = json_decode($req, true);
            if(!isset($data['codigo']) || !isset( $data['nombre']) || !isset( $data['descripcion']) || !isset($data['precio'])){
                return $_respose->error_500();
            }else{
                
                $codigo = $data['codigo'];
                $nombre = $data['nombre'];
                $descripcion = $data['descripcion'];
                $precio = $data['precio'];
                $query = "INSERT INTO producto (codigo, nombre, descripcion, precio, createAt, updateAt) VALUES ($codigo, '$nombre', '$descripcion', $precio, NOW(), NOW())";
                $res = parent::insertId($query);
                if($res){
                    return $res;
                }else{
                    return $_respose->error_500();
                }
                
            }
        
        }

        public function editProducto($req){
            $_respose = new response;
            $data = json_decode($req, true);
            if(!isset($data['id'])){
                return $_respose->error_400();
            }else{
                $id= $data['id'];
                $codigo = $data['codigo'];
                $nombre = $data['nombre'];
                $descripcion = $data['descripcion'];
                $precio = $data['precio'];
                $query = "UPDATE producto SET codigo = $codigo, nombre = '$nombre', descripcion = '$descripcion', precio = $precio, updateAt = NOW() WHERE id = $id";
                $res = parent::insertId($query);
                if($res){
                    return $res;
                }else{
                    return $_respose->error_500();
                }
                
            }
        

        }
        public function deleteProducto($req){
            $_respose = new response;
            $data = json_decode($req, true);
            if(!isset($data['id'])){
                return $_respose->error_400();
            }else{
                $id = $data['id'];
                $query = "DELETE FROM producto WHERE id = $id";
                $res = parent::insert($query);
                if($res){
                    return $res;
                }else{
                    return $_respose->error_500();
                }
                
            }

        }

    }

?>