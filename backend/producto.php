<?php
    require_once 'clases/response.class.php';
    require_once 'clases/producto.class.php';

    $_response = new response;
    $_producto = new producto;

    header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(!isset($_GET['id'])){
        $data = $_producto->listAllProducts();
        header('Content-Type: application/json');
        
        echo json_encode($data);
        http_response_code(200);
        }else{
            $id = $_GET['id'];
            $data = $_producto->getProduct($id);
            header('Content-Type: application/json');
            echo json_encode($data);
            http_response_code(200);
        }

    }else if ($_SERVER['REQUEST_METHOD']=='POST'){
        
        $req = file_get_contents('php://input');
        $res = $_producto->createProducto($req);

        echo json_encode($res);

    }else if ($_SERVER['REQUEST_METHOD']=='PUT'){
        $req = file_get_contents('php://input');
        $res = $_producto->editProducto($req);

        echo json_encode($res);

    }else if ($_SERVER['REQUEST_METHOD']=='DELETE'){
        $req = file_get_contents('php://input');
        $res = $_producto->deleteProducto($req);

        echo json_encode($res);


    }else{
        header('Content-Type: application/json');
        $dataArray = $_response->error_405(); 
        echo json_encode($dataArray);


    }

?>