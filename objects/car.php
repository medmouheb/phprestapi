<?php
class Car
{

    // database connection and table name
    private $conn;
    private $table_name = "cars";

    // object properties
    public $carID;
    public $carName;
    public $family;
    public $carPrice;
    public $NOMBRE_DE_PLACES;
    public $img1;
    public $img2;
    public $img3;
    public $img4;
    public $NOMBRE_DE_CYLINDRES;
    public $ENERGIE;
    public $CONSOMMATION;
    public $boite;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // read products
    function read()
    {

        // select all query
        $query = "SELECT * FROM " . $this->table_name;

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
                    carName=:carName, 
                    family=:family, 
                    carPrice=:carPrice, 
                    NOMBRE_DE_PLACES=:NOMBRE_DE_PLACES, 
                    img1=:img1, 
                    img2=:img2, 
                    img3=:img3, 
                    img4=:img4, 
                    NOMBRE_DE_CYLINDRES=:NOMBRE_DE_CYLINDRES, 
                    ENERGIE=:ENERGIE, 
                    CONSOMMATION=:CONSOMMATION, 
                    boite=:boite";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->carName = htmlspecialchars(strip_tags($this->carName));
        $this->family = htmlspecialchars(strip_tags($this->family));
        $this->carPrice = htmlspecialchars(strip_tags($this->carPrice));
        $this->NOMBRE_DE_PLACES = htmlspecialchars(strip_tags($this->NOMBRE_DE_PLACES));
        $this->img1 = htmlspecialchars(strip_tags($this->img1));
        $this->img2 = htmlspecialchars(strip_tags($this->img2));
        $this->img3 = htmlspecialchars(strip_tags($this->img3));
        $this->img4 = htmlspecialchars(strip_tags($this->img4));
        $this->NOMBRE_DE_CYLINDRES = htmlspecialchars(strip_tags($this->NOMBRE_DE_CYLINDRES));
        $this->ENERGIE = htmlspecialchars(strip_tags($this->ENERGIE));
        $this->CONSOMMATION = htmlspecialchars(strip_tags($this->CONSOMMATION));
        $this->boite = htmlspecialchars(strip_tags($this->boite));
        

        // bind values
        $stmt->bindParam(":carName", $this->carName);
        $stmt->bindParam(":family", $this->family);
        $stmt->bindParam(":carPrice", $this->carPrice);
        $stmt->bindParam(":NOMBRE_DE_PLACES", $this->NOMBRE_DE_PLACES);
        $stmt->bindParam(":img1", $this->img1);
        $stmt->bindParam(":img2", $this->img2);
        $stmt->bindParam(":img3", $this->img3);
        $stmt->bindParam(":img4", $this->img4);
        $stmt->bindParam(":NOMBRE_DE_CYLINDRES", $this->NOMBRE_DE_CYLINDRES);
        $stmt->bindParam(":ENERGIE", $this->ENERGIE);
        $stmt->bindParam(":CONSOMMATION", $this->CONSOMMATION);
        $stmt->bindParam(":boite", $this->boite);
        

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
