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
include_once '../objects/rental.php';

$database = new Database();
$db = $database->getConnection();

$product = new Rental($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (
    !empty($data->id) &&
    !empty($data->matricule) &&
    !empty($data->carID) &&
    !empty($data->rentedfrom) &&
    !empty($data->renredto) &&
    !empty($data->locationID) &&
    !empty($data->insuranceID)
) {

    // set product property values
    $product->id = $data->id;
    $product->matricule = $data->matricule;
    $product->carID = $data->carID;
    $product->rentedfrom = $data->rentedfrom;
    $product->renredto = $data->renredto;
    $product->locationID = $data->locationID;
    $product->insuranceID = $data->insuranceID;


    // create the product
    if ($product->create()) {

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }

    // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => $data));
}
