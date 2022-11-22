<?php
    require_once 'clases/auth.class.php';
    require_once 'clases/response.class.php';

    $_auth = new auth;
    $_response = new response;

    header('Access-Control-Allow-Origin:*'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        //recibe los datos
        $req = file_get_contents('php://input');    
        //se envian los datos para verificar
        $dataArray = $_auth->login($req);


        header('Content-Type: application/json');
        if(isset($dataArray['result']['error_id'])){
            $responseCode = $dataArray['result']['error_id'];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($dataArray);

    }else{
        header('Content-Type: application/json');
        $dataArray = $_response->error_405(); 
        echo json_encode($dataArray);

    }


?>