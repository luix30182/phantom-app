<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
class Product{
 
    // conexion de base de datos y table name
    private $conn;
    private $table_name = "`nota`";
 
    // propiedades objecto
    public $titulo;
    public $contenido;
    public $idNota;
    public $idUsuario;

    
    // constructor con $db como conexión de base de datos
    public function __construct($db){
        $this->conn = $db;
    }

    // leer productos
    function read(){
        // seleccionar todas query
        $query = "SELECT `titulo`,`contenido`,`idNota`,`idUsuario`FROM" .$this->table_name;
        // preparar query statement
        $stmt = $this->conn->prepare($query);
        // executar query
        $stmt->execute();
        return $stmt;
    }
    function read2(){
        // seleccionar todo query
        $query = "SELECT * FROM" .$this->table_name;
        // preparar query statement
        $stmt = $this->conn->prepare($query);
        // executar query
        $stmt->execute();
        return $stmt;   
    }

    function create(){
        // query a registro insrtado
        $query = "INSERT INTO ". $this->table_name . "(`titulo`, `contenido`, `idUsuario`) VALUES(
            '$this->titulo',
            '$this->contenido',
            $this->idUsuario)";
        // echo $query;
        // preparar query
        $stmt = $this->conn->prepare($query);
        // executar query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

        function readOne(){
            // select all query
            $query = "SELECT `titulo`,`contenido`,`idUsuario` FROM $this->table_name WHERE idNota =  $this->idNota";
            // preparar query statement
            $stmt = $this->conn->prepare($query);
            // executar query
            $stmt->execute();

            // obtener fila extraida
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // establecer valores a las propiedades de objeto
            $this->titulo = $row['titulo'];
            $this->contenido = $row['contenido'];
            $this->idUsuario = $row['idUsuario'];
        }

        // actualizar producto
        function update(){
            // actualizar query
            $query = "UPDATE " . $this->table_name . " SET 
            `titulo` = '$this->titulo',
            `contenido` = '$this->contenido'
            WHERE idNota = $this->idNota ";
            // preparar query statement
            $stmt = $this->conn->prepare($query);

            // executar el query
            if($stmt->execute()){
                return true;
            }
        
            return false;
        }
        // eliminar el producto
        function delete(){
            // eliminar query
            $query = "DELETE FROM " . $this->table_name . " WHERE idNota = ?";
            // preparar query
            $stmt = $this->conn->prepare($query);
            // limpiar 
            $this->idNota=htmlspecialchars(strip_tags($this->idNota));
            // enlazar id del registro a eliminar
            $stmt->bindParam(1, $this->idNota);
            // executar query
            if($stmt->execute()){
                return true;
            }
        
            return false;
        
        }
}
?>