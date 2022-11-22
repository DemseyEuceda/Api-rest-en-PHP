<?php
    class response{
        private $res = [
            'status'=>'ok',
            'result'=>array()
        ];
    public function error_405(){
        $this->res['status']= 'error';
        $this->res['result']= array(
            'error_id'=>'405', 
            'error_msg'=>'metodo no permitido'
        );
        return $this->res;
    } 
    public function error_400(){
        $this->res['status']= 'error';
        $this->res['result']= array(
            'error_id'=>'400', 
            'error_msg'=>'datos invalidos'
        );
        return $this->res;
    }    
    public function state_200($string = 'enviado exitosamente'){
        $this->res['status']= 'ok';
        $this->res['result']= array(
            'error_id'=>'200', 
            'error_msg'=> $string
        );
        return $this->res;
    }    
    public function error_500($valor = "Error interno del servidor"){
        $this->res['status'] = "error";
        $this->res['result'] = array(
            "error_id" => "500",
            "error_msg" => $valor
        );
        return $this->res;
    }

    }


?>