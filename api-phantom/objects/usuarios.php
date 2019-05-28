<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
class Product{
    // database connection and table name
    private $conn;
    private $table_name = "`users`";
    // object properties
    public $idUsuario;
    public $password; 
    public $name; 
    public $email; 
    public $create_time; 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read users
    function read(){
        // select all query
        $query = "SELECT `idUsuario`,`name`, `email`, `create_time`FROM " .$this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function readOne(){
        // select all query
        $query = "SELECT `name`,`email`,`password`,`create_time` FROM $this->table_name WHERE idUsuario = $this->idUsuario";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->create_time = $row['create_time'];
    }
    function create(){
        // query to insert record
        $query = "INSERT INTO ". $this->table_name . "(`name`, `email`, `password`) VALUES('$this->name',
            '$this->email',
            '$this->password')";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
        return true;
        }
        return false;
    }
    function update(){
        // actualizar query
        $query = "UPDATE " . $this->table_name . " SET 
        `name` = '$this->name',
        `password` = '$this->password',
        `email` = '$this->email' WHERE idUsuario = $this->idUsuario";
        // preparar query statement
        echo $query;
        $stmt = $this->conn->prepare($query);
        // executar the query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>