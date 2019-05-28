<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include base de datos y object files
include_once '../config/database.php';
include_once '../objects/usuarios.php';
 
// instanciamineto de base datos
$database = new Database();
$db = $database->getConnection();
 
// inicializar objecto
$product = new Product($db);
// query productos
$stmt = $product->read();
$num = $stmt->rowCount();

// revisa si más de 0 registros fueron encontrados
if($num>0){
    $products_arr=array();
    $products_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $product_item=array(
            "idUsuario" => $idUsuario, 
            "name" => $name,
            "email" => $email,
            "create_time" => $create_time
        );
        array_push($products_arr["records"], $product_item);
    } 
    // codigo de respuesta - 200 OK
    http_response_code(200);
    // muestra los datos del producto en formato json
    echo json_encode($products_arr);
}