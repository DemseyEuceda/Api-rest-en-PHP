<?php
    require_once 'db/db.php';
    require_once 'response.class.php';
    class auth extends db{
        public function login($json){
            $_response = new response;
            $data = json_decode($json, true);
            if(!isset($data['user']) || !isset($data['password'])){
                return $_response->error_400();

            }else{
                $user = $data['user'];
                $password = $data['password'];
                $data = $this->getDataUser($user);
                if($data){
                    if($data[0]['password'] == $password){
                        return $data;
                    }else{
                        return $_response->state_200("la contraseña de $user es incorrecta");
                    }
                     
                }else{
                    return $_response->state_200("el usuario $user no existe");
                }

            }
        }

        private function getDataUser($correo ){
            $query = "SELECT id, correo, password FROM usuario WHERE correo = '$correo'";
            $data = parent::getData($query);
            if(isset($data[0]['id'])){
                return $data;
            }else{
                return 0;
            }

        }
   
    }

?>