<?php
    require_once 'clases/response.class.php';
    require_once 'clases/producto.class.php';

    $_response = new response;
    $_producto = new producto;

    @header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    header("Content-Type: application/json");
    header("Access-Control-Allow-Credentials: true");
    header("SameSite: None");
    if($_SERVER['REQUEST_METHOD']=='POST'){
            $req = file_get_contents('php://input');
            $data = $_producto->getProductById($req);
            header('Content-Type: application/json');
            echo json_encode($data);
            http_response_code(200);
        }

?>