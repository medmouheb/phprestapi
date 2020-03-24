<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/car.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$car = new Car($db);

// query cars
$stmt = $car->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // cars array
    $cars_arr = array();
    $cars_arr["cars_list"] = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $car_item = array(
            "carID" => $carID,
            "carName" => $carName,
            "family" => $family,
            "carPrice" => $carPrice,
            "NOMBRE_DE_PLACES" => $NOMBRE_DE_PLACES,
            "img1" => $img1,
            "img2" => $img2,
            "img3" => $img3,
            "img4" => $img4,
            "NOMBRE_DE_CYLINDRES" => $NOMBRE_DE_CYLINDRES,
            "ENERGIE" => $ENERGIE,
            "CONSOMMATION" => $CONSOMMATION,
            "boite" => $boite,

        );

        array_push($cars_arr["cars_list"], $car_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show cars data in json format
    echo json_encode($cars_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No cars found.")
    );
}
