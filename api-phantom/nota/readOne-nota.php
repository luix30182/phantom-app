<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include de base de datos y object files
include_once '../config/database.php';
include_once '../objects/nota.php';
 
// get conexión base de datos
$database = new Database();
$db = $database->getConnection();
 
// preparar object producto
$product = new Product($db);
 
// obtener propiedad de id del registro a leer 
$product->idNota = isset($_GET['idNota']) ? $_GET['idNota'] : die();
 
// leer los detalles del producto que va a ser modificado
$product->readOne();

if($product->titulo!=null){
    // crear array
    $product_arr = array(
        "idUsuario" => $product->idUsuario, 
        "titulo" => $product->titulo,
        "contenido" => $product->contenido
    );
 
    // set codigo de respuesta - 200 OK
    http_response_code(200);
 
    // hacerlo formato json
    echo json_encode($product_arr);
}
 
else{
    // codigo de respuesta - 404 Not found
    http_response_code(404);
 
    // notificar al usuario que el producto no existe
    echo json_encode(array("message" => "Nota does not exist"));
}
?>