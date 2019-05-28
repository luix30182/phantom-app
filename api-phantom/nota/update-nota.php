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
 
// get conexión base de datos
$database = new Database();
$db = $database->getConnection();
 
// preparar object producto
$product = new Product($db);
 
// obtener el id del producto a ser editado
$data = json_decode(file_get_contents("php://input"));
 
// establecer la propiedad del id del producto a modificar
$product->idNota = $data->idNota;
 
// set product property values
$product->titulo = $data->titulo;
$product->contenido = $data->contenido;
 
// actualizar el producto
if($product->update()){
 
    // codigo de respuesta - 200 ok
    http_response_code(200);
 
    // notificar al usuario
    echo json_encode(array("message" => "Nota was updated"));
}
 
// si no se puede actualizar, notifica al usuario
else{
 
    // establece codigo de respuesta - 503 service unavailable
    http_response_code(503);
 
    // notifica al usuario
    echo json_encode(array("message" => "Unable to update nota"));
}
?>