<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "`nota`";
 
    // object properties
    public $titulo;
    public $contenido;
    public $idNota;
    public $idUsuario;

    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
        // select all query
        $query = "SELECT `titulo`,`contenido`,`idNota`,`idUsuario`FROM" .$this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function read2(){
        // select all query
        $query = "SELECT * FROM" .$this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;   
    }

    function create(){
        // query to insert record
        $query = "INSERT INTO ". $this->table_name . "(`titulo`, `contenido`, `idUsuario`) VALUES(
            '$this->titulo',
            '$this->contenido',
            $this->idUsuario)";
        // echo $query;
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

        function readOne(){
            // select all query
            $query = "SELECT `titulo`,`contenido`,`idUsuario` FROM $this->table_name WHERE idNota =  $this->idNota";
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();

            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set values to object properties
            $this->titulo = $row['titulo'];
            $this->contenido = $row['contenido'];
            $this->idUsuario = $row['idUsuario'];
        }

        // update the product
        function update(){
            // update query
            $query = "UPDATE " . $this->table_name . " SET 
            `titulo` = '$this->titulo',
            `contenido` = '$this->contenido'
            WHERE idNota = $this->idNota ";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // execute the query
            if($stmt->execute()){
                return true;
            }
        
            return false;
        }
        // delete the product
        function delete(){
            // delete query
            $query = "DELETE FROM " . $this->table_name . " WHERE idNota = ?";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->idNota=htmlspecialchars(strip_tags($this->idNota));
            // bind id of record to delete
            $stmt->bindParam(1, $this->idNota);
            // execute query
            if($stmt->execute()){
                return true;
            }
        
            return false;
        
        }
}
?>