<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/car.php';
  
$database = new Database();
$db = $database->getConnection();
  
$product = new Car($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->carName) &&
    !empty($data->family) &&
    !empty($data->carPrice) &&
    !empty($data->NOMBRE_DE_PLACES) &&
    !empty($data->img1) &&
    !empty($data->img2) &&
    !empty($data->img3) &&
    !empty($data->img4) &&
    !empty($data->NOMBRE_DE_CYLINDRES) &&
    !empty($data->ENERGIE) &&
    !empty($data->CONSOMMATION) &&
    !empty($data->boite) 
){
  
    // set product property values
    $product->carName = $data->carName;
    $product->family = $data->family;
    $product->carPrice = $data->carPrice;
    $product->NOMBRE_DE_PLACES = $data->NOMBRE_DE_PLACES;
    $product->img1 = $data->img1;
    $product->img2 = $data->img2;
    $product->img3 = $data->img3;
    $product->img4 = $data->img4;
    $product->NOMBRE_DE_CYLINDRES = $data->NOMBRE_DE_CYLINDRES;
    $product->ENERGIE = $data->ENERGIE;
    $product->CONSOMMATION = $data->CONSOMMATION;
    $product->boite = $data->boite;
    
  
    // create the product
    if($product->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>