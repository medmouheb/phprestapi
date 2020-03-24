<?php
class Location
{

    // database connection and table name
    private $conn;
    private $table_name = "location";

    // object properties
    public $locationID;
    public $state;
    public $address;
    public $mapcord;
    public $locationImg;


    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read()
    {

        // select all query
        $query = "SELECT * from " . $this->table_name;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    function create()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    locationID=:locationID, 
                    state=:state,
                    address=:address,
                    mapcord=:mapcord,
                    locationImg=:locationImg";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->locationID = htmlspecialchars(strip_tags($this->locationID));
        $this->state = htmlspecialchars(strip_tags($this->state));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->mapcord = htmlspecialchars(strip_tags($this->mapcord));
        $this->locationImg = htmlspecialchars(strip_tags($this->locationImg));
        


        // bind values
        $stmt->bindParam(":locationID", $this->locationID);
        $stmt->bindParam(":state", $this->state);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":mapcord", $this->mapcord);
        $stmt->bindParam(":locationImg", $this->locationImg);
        


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
