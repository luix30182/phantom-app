<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
 
// get database connection
include_once '../config/database.php';
// instantiate product object
include_once '../objects/usuarios.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
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
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "User was created"));
    }
    // if unable to create the product, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create user"));
    }
}
// tell the user data is incomplete
else{
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
}
?>