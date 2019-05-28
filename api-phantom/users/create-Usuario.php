<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
 
// conexión connection
include_once '../config/database.php';
// instanciar el objeto producto
include_once '../objects/usuarios.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
// obtener datos 
$data = json_decode(file_get_contents("php://input"));
 
// asegurarse que los datos no estén vacios
if(
    !empty($data->name) &&
    !empty($data->email) &&
    !empty($data->password)
    ){
 
    // set product property values
    $product->name = $data->name;
    $product->email = $data->email;
    $product->password = $data->password;
    // create the product
    if($product->create()){
        //codigo de respuesta - 201 created
        http_response_code(201);
        // notificar al usuario
        echo json_encode(array("message" => "User was created"));
    }
    // si no se puede crear producto, notifica al usuario
    else{
        // codigo de respuesta - 503 service unavailable
        http_response_code(503);
        // notifica al usuario
        echo json_encode(array("message" => "Unable to create user"));
    }
}
// Notifica al usuario de que los datos están incompletos
else{
    // codigo de respuesta - 400 bad request
    http_response_code(400);
    // notifica al usuario
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
}
?>