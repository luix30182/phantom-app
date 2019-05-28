<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include de base de datos y object files
include_once '../config/database.php';
include_once '../objects/nota.php';
 
// conexión base de datos
$database = new Database();
$db = $database->getConnection();
 
// preparar object producto
$product = new Product($db);
 
// get producto id
$data = json_decode(file_get_contents("php://input"));
 
// set producto id para ser eliminado
$product->idNota = $data->idNota;
 
// eliminar el producto
if($product->delete()){
 
    // codigo de respuesta - 200 ok
    http_response_code(200);
 
    // notificar al usuario
    echo json_encode(array("message" => "Nota was deleted"));
}
 
// si no es posible eliminar el producto
else{
 
    // codigo de respuesta - 503 service unavailable
    http_response_code(503);
 
    // notificar al usuario
    echo json_encode(array("message" => "Unable to delete nota"));
}
?>