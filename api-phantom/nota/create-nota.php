<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
 
// get database connection
include_once '../config/database.php';
// instantiate product object
include_once '../objects/nota.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->idUsuario) &&
    !empty($data->titulo) &&
    !empty($data->contenido)
    ){
 
    // set product property values
    $product->titulo = $data->titulo;
    $product->contenido = $data->contenido;
    $product->idUsuario = $data->idUsuario;
 
    // create the product
    if($product->create()){
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "Nota was created"));
    }
    // if unable to create the product, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create nota"));
    }
}
// tell the user data is incomplete
else{
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create nota. Data is incomplete."));
}
?>