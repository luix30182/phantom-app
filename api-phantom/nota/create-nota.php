<?php
// headers requeridos
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
 
// conexión base de datos
include_once '../config/database.php';
// instanciar objeto producto
include_once '../objects/nota.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
// obtener datos posteados
$data = json_decode(file_get_contents("php://input"));
 
// verificar que los datos no están vacios
if(
    !empty($data->idUsuario) &&
    !empty($data->titulo) &&
    !empty($data->contenido)
    ){
 
    // poner a lor productos valores adecuados
    $product->titulo = $data->titulo;
    $product->contenido = $data->contenido;
    $product->idUsuario = $data->idUsuario;
 
    // crear el producto
    if($product->create()){
        // codigo de respuesta - 201 creado
        http_response_code(201);
        // decirle al usuario
        echo json_encode(array("message" => "Nota was created"));
    }
    // si no se puede crear el producto, notificar al usuario
    else{
        // codigo de respuesta - 503 servicio no disponible
        http_response_code(503);
        // notificar al usuario
        echo json_encode(array("message" => "Unable to create nota"));
    }
}
// NOtificar al usuario que los datos están incompletos
else{
    // scodigo de respueta - 400 bad request
    http_response_code(400);
    // notificar al usuario
    echo json_encode(array("message" => "Unable to create nota. Data is incomplete."));
}
?>