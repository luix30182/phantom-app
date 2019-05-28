<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include base de datos y object files
include_once '../config/database.php';
include_once '../objects/usuarios.php';
 
// conexión base de datos
$database = new Database();
$db = $database->getConnection();
 
// preparar objeto de producto
$product = new Product($db);
 
// establcer la propiedad de id a leer
$product->idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : die();
 
// leer los detalles del producto a ser modificado
$product->readOne();

if($product->name!=null){
    // crear array
    $product_arr = array(
        "idUsuario" => $product->idUsuario, 
        "name" => $product->name,
        "email" => $product->email,
        "password" => $product->password,
        "create_time" => $product->create_time
    );
 
    // codigo de respuesta - 200 OK
    http_response_code(200);
 
    // hacerlo formato json
    echo json_encode($product_arr);
}
 
else{
    //codigo de repsuesta - 404 Not found
    http_response_code(404);
 
    // notificar que producto de usuario no existe +
    echo json_encode(array("message" => "User does not exist"));
}
?>