<?php
  class Product {
    //Instancia de conexion
    private $connection;
    //Nombre de la tabla
    private $table_name = "productos";
    //Campos en la tabla --> Igual que como fueron nombrados
    public $id;
    public $nombre;
    public $imagen;
    public $precio;
    public $stock;

    //Constructor de la clase --> Se le tiene que pasar una instancia no nulla de la conexion
    function __construct($connection) {
      $this->connection = $connection;
    }

    //Funcion para crear un producto
    public function crear_producto($nombre, $imagen, $precio, $stock, $categoria, $subcategoria){
      $query =  "INSERT INTO ".$this->table_name."  VALUES (0,:imagen,:nombre,:precio, :categoria,:subcategoria,:stock)";
      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(":imagen",$imagen);
      $stmt->bindParam(":nombre",$nombre);
      $stmt->bindParam(":precio",$precio);
      $stmt->bindParam(":categoria",$categoria);
      $stmt->bindParam(":subcategoria",$subcategoria);
      $stmt->bindParam(":stock",$stock);
      if ($stmt->execute()) {
        $this->connection.close();
        return true;
      } else {
        return false;
      }
      return $stm;
    }

    //Funcion para obtener un solo producto
    public function get_productos_categoria($categoria){
      $query = "SELECT * FROM ".$this->table_name." WHERE categoria = :nombre_categoria ";
      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(":nombre_categoria", $categoria);
      $stmt->execute();
      $this->connection.close();
      return $stmt;
    }

  }
?>
