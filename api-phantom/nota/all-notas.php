<?php
// headers requeridos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include de base de datos y object files
include_once '../config/database.php';
include_once '../objects/nota.php';
 
// instanciar base de datos y game object
$database = new Database();
$db = $database->getConnection();
 
// inicializar objeto
$product = new Product($db);
// query productos
$stmt = $product->read();
$num = $stmt->rowCount();

// revisar si más de 0 registros son encontrados
if($num>0){
    $products_arr=array();
    $products_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $product_item=array(
            "titulo" => $titulo,
            "contenido" => $contenido,
            "idNota" => $idNota,
            "idUsuario" => $idUsuario
        );
        array_push($products_arr["records"], $product_item);
    } 
    // codigo de respuesta - 200 OK
    http_response_code(200);
    // mostrar los datos del producto en formato json
    echo json_encode($products_arr);
}