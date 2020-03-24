<?php
class Rental
{

    // database connection and table name
    private $conn;
    private $table_name = "rental";

    // object properties
    public $id;
    public $matricule;
    public $rentedfrom;
    public $renredto;

    public $insuranceID;
    public $name;
    public $description;
    public $insurancePrice;

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
        $query = "SELECT * FROM `rental` ,`cars`,`insurance`,`location`
        where 
        `rental`.`carID`=`cars`.`carID` AND
        `rental`.`locationID`=`location`.`locationID` AND
        `rental`.`insuranceID`=`insurance`.`insuranceID`";

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
                id=:id, 
                matricule=:matricule, 
                carID=:carID, 
                rentedfrom=:rentedfrom, 
                renredto=:renredto, 
                locationID=:locationID, 
                insuranceID=:insuranceID";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->matricule = htmlspecialchars(strip_tags($this->matricule));
        $this->carID = htmlspecialchars(strip_tags($this->carID));
        $this->rentedfrom = htmlspecialchars(strip_tags($this->rentedfrom));
        $this->renredto = htmlspecialchars(strip_tags($this->renredto));
        $this->locationID = htmlspecialchars(strip_tags($this->locationID));
        $this->insuranceID = htmlspecialchars(strip_tags($this->insuranceID));
        
        

        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":matricule", $this->matricule);
        $stmt->bindParam(":carID", $this->carID);
        $stmt->bindParam(":rentedfrom", $this->rentedfrom);
        $stmt->bindParam(":renredto", $this->renredto);
        $stmt->bindParam(":locationID", $this->locationID);
        $stmt->bindParam(":insuranceID", $this->insuranceID);
        
        

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
